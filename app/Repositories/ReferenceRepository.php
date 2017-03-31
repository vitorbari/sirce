<?php namespace Sirce\Repositories;

use DB;
use Carbon\Carbon;
use \Storage;
use \ZipArchive;

use Sirce\Http\Requests\StoreReferenceRequest;
use Sirce\Models\Component;
use Sirce\Models\Language;
use Sirce\Models\Reference;
use Sirce\Models\User;

class ReferenceRepository
{

    public function create(StoreReferenceRequest $request)
    {
        $reference = new Reference();

        return $this->update($reference, $request);
    }

    public function update(Reference $reference, StoreReferenceRequest $request)
    {
        $inputs = $request->all();

        if(array_key_exists('draft', $inputs)) { // raschunho
            $inputs['published_at'] = NULL;
        } elseif(! $reference->published_at) { // nao eh rescunho e nao estava publicado
            $inputs['published_at'] = time();
        }

        $reference->fill($inputs);

        if(array_key_exists('user_id', $inputs)) {
            $reference->user()->associate(User::findOrFail($inputs['user_id']));
        }

        $reference->component()->associate(Component::findOrFail($inputs['component_id']));
        $reference->language()->associate(Language::findOrFail($inputs['language_id']));

        if ($request->hasFile('attachments')) {

            $directory_name = uniqid('reference-');

            $directory = storage_path() . '/app/' . $directory_name;

            mkdir($directory);

            foreach ($request->file('attachments') as $key => $attachment) {
                if ($attachment->isValid()) {
                    $orignal_name = $attachment->getClientOriginalName();

                    $sanitized = preg_replace('/[^a-zA-Z0-9-_\.]/','', $orignal_name);
                    $sanitized = substr($sanitized, 0, strrpos($sanitized, '.')); // remove extension

//                    $filename =  $sanitized . '.' . $attachment->getExtension();

                    $extension = substr($orignal_name, strrpos($orignal_name, '.') + 1);
                    $filename =  $sanitized . '.' . $extension;

                    $attachment->move($directory, $filename);
                }
            }

            $reference->directory = $directory_name;
        }

        $reference->save();

        if (isset($inputs['board_id'])) {
            $reference->boards()->sync($inputs['board_id']);
        }

        return $reference;
    }

    public function publish(Reference $reference)
    {
        if($reference->published_at) {
            return FALSE;
        }

        $reference->published_at = time();

        return $reference->save();
    }

    public function getPaginated($params = [])
    {
        $references = Reference::with('user', 'component')
            ->whereNotNull('published_at')
            ->orderBy('id', 'desc');

        foreach ($params as $field => $value) {
            if (!empty($value)) {
                switch ($field) {
                    case 'title':
                        $references = $references->where($field, 'like', '%' . $value . '%');
                        break;

                    case 'author':
                        // TODO: filter by user
                        die('// TODO: filter by user');
                }
            }
        }

        return $references->paginate(16);
    }

    public function getAll()
    {
        return Reference::whereNotNull('published_at')->get();
    }

    public function search($needle='')
    {
        $references = Reference::join('users', 'users.id', '=', 'user_id')
            ->where('title', 'like', '%'.$needle.'%')
            ->whereNotNull('published_at')
            ->limit(5)
            ->get();

        $results = [];

        foreach($references as $reference)
        {
            $results[] = [
                'id'      => $reference->id,
                'title'   => $reference->title,
                'name'    => $reference->user->name,
                'picture' => $reference->component->picture,
                'url'     => route('sketches.show', [$reference->id])
            ];
        }

        return $results;
    }

    public function listsLanguages()
    {
        return Language::lists('language', 'id');
    }

    public function getMostFavorited()
    {
        return Reference::whereNotNull('published_at')
            ->with('favorites', 'user')->get()->sortByDesc(function ($reference) {
                return $reference->favorites->count();
            })->take(5);
    }

    public function getMostViewed()
    {
        return Reference::whereNotNull('published_at')
            ->orderBy('views', 'desc')
            ->limit(5)
            ->get();
    }

    public function getWeekFavoritedCount()
    {
        return DB::table('user_favorites')
            ->where('created_at', '>=', Carbon::now()->subWeek())
            ->count();
    }

    public function incrementViews(Reference $reference)
    {
        return $reference->increment('views');
    }

    public function getWeekCreatedCount()
    {
        return Reference::whereNotNull('published_at')
            ->where('created_at', '>=', Carbon::now()->subWeek())
            ->count();
    }

    public function star(Reference $reference, User $user)
    {
        return $reference->favorites()->attach($user->id);
    }

    public function unstar(Reference $reference, User $user)
    {
        return $reference->favorites()->detach($user->id);
    }

    public function userStarred(Reference $reference, User $user)
    {
        return $reference->favorites->contains($user->id);
    }

    /**
     * Get array of files (only name)
     *
     * @param Reference $reference
     * @return array
     */
    public function getFiles(Reference $reference)
    {
        $directory = $reference->directory;

        if(!$directory) {
            return array();
        }

        $files = Storage::files($directory);

        return array_map('basename', $files);
    }

    /**
     * Generates a zip with all files
     *
     * @param Reference $reference
     * @return string
     * @throws \Exception
     */
    public function getCompressedFiles(Reference $reference)
    {
        $files = $this->getFiles($reference);

        $zip = new ZipArchive();

        $filename = storage_path() . '/app/' . $reference->directory . ".zip";

        if ($zip->open($filename, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE)!==TRUE) {
            throw new \Exception("cannot open <$filename>\n");
        }

        // coloca arquivos dentro de diretorio
        $zip_directory = uniqid('sirce-');

        foreach($files as $file) {
            $zip->addFile($this->getFile($reference, $file), $zip_directory . '/' .$file);
        }

        $zip->close();

        return $filename;
    }

    /**
     * Gets file with full path
     *
     * @param Reference $reference
     * @param $file
     * @return string
     */
    public function getFile(Reference $reference, $file)
    {
        $directory = storage_path() . '/app/'.$reference->directory.'/';

        return $directory.$file;

    }

}