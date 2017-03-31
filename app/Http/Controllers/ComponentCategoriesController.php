<?php namespace Sirce\Http\Controllers;

use SEO;

use Sirce\Http\Requests;
use Sirce\Http\Controllers\Controller;

use Sirce\Http\Requests\StoreComponentCategoryRequest;
use Sirce\Models\ComponentCategory;
use Sirce\Repositories\ComponentRepository;

class ComponentCategoriesController extends Controller {


	/**
	 * @var ComponentRepository
	 */
	private $componentRepository;

	function __construct(ComponentRepository $componentRepository)
	{
		$this->componentRepository = $componentRepository;
	}

	public function create()
	{
		$categories = $this->componentRepository->getCategoriesList('-');

		$form_route = 'component_categories.store';

		return view('component_categories.edit', compact(
			'form_route',
			'categories'
		));
	}

	public function store(StoreComponentCategoryRequest $request)
	{
		$this->componentRepository->createCategory($request);

		flash()->success('Component Category created!');

		return redirect()->route('components.index');
	}

	public function edit(ComponentCategory $component_category)
	{
		$categories = $this->componentRepository->getCategoriesList('-');

		$form_route = 'component_categories.update';

		return view('component_categories.edit', compact(
			'component_category',
			'form_route',
			'categories'
		));
	}

	public function update(ComponentCategory $component_category, StoreComponentCategoryRequest $request)
	{
		$this->componentRepository->updateCategory($component_category, $request);

		flash()->success('Component Category updated!');

		return redirect()->route('components.index');
	}

}
