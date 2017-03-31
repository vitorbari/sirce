<?php namespace Sirce\Repositories\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Sirce\Models\Picture;

trait ImageUploadTrait
{
    /**
     * @param Model $model
     * @param Request $request
     * @param string $name
     */
    public function moveUploadedImage(Model $model, Request $request, $name = 'picture')
    {
        if ($request->hasFile($name)) {
            $file = $request->file($name);
            if ($file->isValid()) {

                // delete old pics
                $model->pictures()->delete();

                $orignal_name = $file->getClientOriginalName();

                $sanitized = preg_replace('/[^a-zA-Z0-9-_\.]/','', $orignal_name);
                $sanitized = substr($sanitized, 0, strrpos($sanitized, '.')); // remove extension

                $filename = $sanitized.'.'.$file->guessExtension();

                $file->move(public_path('uploads'), $filename);

                $picture = new Picture();
                $picture->path = $filename;

                $model->pictures()->save($picture);
            }
        }
    }
}