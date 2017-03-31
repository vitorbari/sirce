<?php namespace Sirce\Http\Controllers;

use SEO;
use \File;
use Sirce\Http\Requests;
use Sirce\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use \Parsedown;
use Sirce\Http\Requests\StoreReferenceRequest;
use Sirce\Models\Reference;
use Sirce\Repositories\BoardRepository;
use Sirce\Repositories\ComponentRepository;
use Sirce\Repositories\McuRepository;
use Sirce\Repositories\ReferenceRepository;

class ReferenceController extends Controller
{

    /**
     * @var ReferenceRepository
     */
    private $referenceRepository;

    public function __construct(ReferenceRepository $referenceRepository)
    {
        $this->referenceRepository = $referenceRepository;

        $this->middleware('auth', ['except' => ['index', 'show', 'file', 'files']]);
        $this->middleware('admin', ['only' => ['create', 'store', 'edit', 'update', 'publish', 'preview']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        SEO::setTitle('Sketches');
        SEO::setDescription('List of sketches');

        $fields = ['title', 'author'];

        $references = $this->referenceRepository->getPaginated($request->only($fields));

        return view('references.index', compact('references', 'fields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param BoardRepository $boardRepository
     * @param ComponentRepository $componentRepository
     * @return Response
     */
    public function create(BoardRepository $boardRepository, ComponentRepository $componentRepository)
    {
        SEO::setTitle('Create a sketche');
        SEO::setDescription('Sketches creation.');

        $languages      = $this->referenceRepository->listsLanguages();
        $board_families = $boardRepository->getFamilies();
        $categories     = $componentRepository->getCategoriesList('-');

        $form_route = 'sketches.store';

        return view('references.edit', compact(
            'languages',
            'board_families',
            'categories',
            'form_route'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReferenceRequest $request
     * @param Guard $auth
     * @return Response
     */
    public function store(StoreReferenceRequest $request, Guard $auth)
    {
        $request->merge(['user_id' => $auth->id()]);

        $reference = $this->referenceRepository->create($request);

        flash()->success('Sketch created!');

        return redirect()->route('sketches.show', $reference->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  Reference $reference
     * @param Guard $auth
     *
     * @return Response
     */
    public function show(Reference $reference, Guard $auth)
    {
        SEO::setTitle($reference->title);
        SEO::setDescription($reference->title . ' by '.$reference->user->name);

        $logged_user = $auth->user();

        $is_creator = $logged_user ? ($logged_user->id == $reference->user_id) : FALSE;

        if(!$reference->published_at)
        {
            if(!$is_creator)
            {
                abort(404);
            }
        }

        if(!$is_creator)
        {
            $this->referenceRepository->incrementViews($reference);
        }

        $files = $this->referenceRepository->getFiles($reference);

        $user_starred = $logged_user ? $this->referenceRepository->userStarred($reference, $logged_user) : FALSE;

        $comments_section = TRUE;

        $parsed_markdown = (new Parsedown)->text(htmlentities($reference->markdown));

        $component_category_hierarchy = $reference->component->category->getAncestorsAndSelfWithoutRoot()->lists('category');

        return view('references.show', compact(
            'reference',
            'is_creator',
            'parsed_markdown',
            'files',
            'comments_section',
            'user_starred',
            'component_category_hierarchy'
        ));
    }


    /**
     * @param  Reference $reference
     * @param $file
     * @return Response
     */
    public function file(Reference $reference, $file, Request $request)
    {
        $file_path = $this->referenceRepository->getFile($reference, $file);

//        if($request->input('raw') === 'true') {
//            return response(File::get($file_path), 200)->header('Content-Type', File::mimeType($file_path));
//        } else {
            return response()->download($file_path, $file, []);
//        }
    }

    /**
     * @param  Reference $reference
     * @return Response
     */
    public function files(Reference $reference)
    {
        $zip_file = $this->referenceRepository->getCompressedFiles($reference);

        return response()->download($zip_file, basename($zip_file));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Reference $reference
     * @param Guard $auth
     * @param BoardRepository $boardRepository
     * @param ComponentRepository $componentRepository
     * @return Response
     */
    public function edit(Reference $reference, Guard $auth, BoardRepository $boardRepository, ComponentRepository $componentRepository)
    {
        if($auth->id() != $reference->user_id)
        {
            abort(404);
        }

        $languages      = $this->referenceRepository->listsLanguages();
        $board_families = $boardRepository->getFamilies();
        $categories     = $componentRepository->getCategoriesList('-');

        $form_route = 'sketches.update';

        return view('references.edit', compact(
            'reference',
            'languages',
            'board_families',
            'categories',
            'form_route'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Reference $reference
     * @param StoreReferenceRequest $request
     *
     * @return Response
     */
    public function update(Reference $reference, StoreReferenceRequest $request)
    {
        $reference = $this->referenceRepository->update($reference, $request);

        flash()->success('Sketch updated!');

        return redirect()->route('sketches.show', $reference->id);
    }


    /**
     * @param  Reference $reference
     * @param Guard $auth
     * @return Response
     */
    public function publish(Reference $reference, Guard $auth)
    {
        if($auth->id() != $reference->user_id)
        {
            abort(404);
        }

        $published = $this->referenceRepository->publish($reference);

        if($published) {
            flash()->success('Sketch published!');
        }

        return redirect()->route('sketches.show', $reference->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Reference $reference
     *
     * @return Response
     */
//    public function destroy(Reference $reference)
//    {
//        //
//    }

    /**
     * Star the specified resource.
     *
     * @param  Reference $reference
     * @param Guard $auth
     *
     * @return Response
     */
    public function star(Reference $reference, Guard $auth)
    {
        $this->referenceRepository->star($reference, $auth->user());

        flash()->success('Sketch starred!');

        return redirect()->route('sketches.show', $reference->id);
    }

    /**
     * Untar the specified resource.
     *
     * @param  Reference $reference
     * @param Guard $auth
     *
     * @return Response
     */
    public function unstar(Reference $reference, Guard $auth)
    {
        $this->referenceRepository->unstar($reference, $auth->user());

        flash()->info('Sketch unstarred!');

        return redirect()->route('sketches.show', $reference->id);
    }

    public function preview(Request $request)
    {
        $input = $request->input('markdown');

        return response((new Parsedown)->text($input));
    }

    public function boards(Request $request, BoardRepository $boardRepository)
    {
        $input = $request->input('query');

        $boards = $boardRepository->search($input);

        return response()->json($boards);
    }

    public function mcus(Request $request, McuRepository $mcuRepository)
    {
        $input = $request->input('query');

        $mcus = $mcuRepository->search($input);

        return response()->json($mcus);
    }

}
