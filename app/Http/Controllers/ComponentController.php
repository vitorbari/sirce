<?php namespace Sirce\Http\Controllers;

use SEO;

use Sirce\Http\Requests;
use Sirce\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Sirce\Http\Requests\StoreComponentRequest;
use Sirce\Models\Component;
use Sirce\Repositories\ComponentRepository;
use Sirce\Repositories\ManufacturerRepository;

class ComponentController extends Controller {


	/**
	 * @var ComponentRepository
	 */
	private $componentRepository;
	/**
	 * @var ManufacturerRepository
	 */
	private $manufacturerRepository;

	function __construct(ComponentRepository $componentRepository, ManufacturerRepository $manufacturerRepository)
	{
		$this->componentRepository = $componentRepository;
		$this->manufacturerRepository = $manufacturerRepository;

		$this->middleware('admin', ['except' => ['index', 'category', 'show']]);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		SEO::setTitle('Components');
		SEO::setDescription('List of components');

		$fields = ['component_category_id'];

		$categories_list = $this->componentRepository->getCategoriesList('&nbsp;&nbsp;');

		$components = $this->componentRepository->getPaginated($request->only($fields));

		return view('components.index', compact(
			'components',
			'categories_list',
			'fields'
		));
	}

	public function category($component_category_id)
	{
		$components = $this->componentRepository->getByCategory($component_category_id);

		return response()->json($components);
	}

	public function create()
	{
		$categories = $this->componentRepository->getCategoriesList('-');
		$manufacturers  = ['' => ''] + $this->manufacturerRepository->lists();

		$form_route = 'components.store';

		return view('components.edit', compact(
			'form_route',
			'categories',
			'manufacturers'
		));
	}

	public function store(StoreComponentRequest $request)
	{
		$component = $this->componentRepository->create($request);

		flash()->success('Component created!');

		return redirect()->route('components.show', $component->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Component $component
	 *
	 * @return Response
	 */
	public function show(Component $component)
	{
		SEO::setTitle($component->component);
		SEO::setDescription('Component ' . $component->component. ' details and sketches');

		$this->componentRepository->incrementViews($component);

		$comments_section = TRUE;

		$category = $component->category;

		if($category->isRoot()) {
			$component_category_hierarchy = $category->getAncestorsAndSelf()->lists('category');
		} else {
			$component_category_hierarchy = $category->getAncestorsAndSelfWithoutRoot()->lists('category');
		}

		return view('components.show', compact('component', 'comments_section', 'component_category_hierarchy'));
	}

	public function edit(Component $component)
	{
		$categories = $this->componentRepository->getCategoriesList('-');
		$manufacturers  = ['' => ''] + $this->manufacturerRepository->lists();

		$form_route = 'components.update';

		return view('components.edit', compact(
			'component',
			'form_route',
			'categories',
			'manufacturers'
		));
	}

	public function update(Component $component, StoreComponentRequest $request)
	{
		$component = $this->componentRepository->update($component, $request);

		flash()->success('Component updated!');

		return redirect()->route('components.show', $component->id);
	}

}
