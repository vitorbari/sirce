<?php namespace Sirce\Repositories;

use Carbon\Carbon;
use Sirce\Http\Requests\StoreComponentCategoryRequest;
use Sirce\Http\Requests\StoreComponentRequest;
use Sirce\Models\Component;
use Sirce\Models\ComponentCategory;
use Sirce\Repositories\Traits\ImageUploadTrait;

class ComponentRepository
{

	use ImageUploadTrait;

	public function getPaginated($params = [])
	{
		$components = Component::orderBy('component');

		foreach ($params as $field => $value) {
			if (!empty($value)) {
				switch ($field) {
					case 'component':
						$components = $components->where($field, 'like', $value . '%');
						break;

					case 'component_category_id':
						$category = ComponentCategory::findOrFail($value);
						$descendants = $category->getDescendantsAndSelf(['id'])->lists('id');

						$components = $components->whereIn($field, $descendants);
						break;
				}
			}
		}

		return $components->paginate(16);
	}

	public function getAll()
	{
		return Component::orderBy('component')->get();
	}

	public function getByCategory($component_category_id)
	{
		$category = ComponentCategory::findOrFail($component_category_id);
		$descendants = $category->getDescendantsAndSelf(['id'])->lists('id');

		return Component::orderBy('component')
			->select(['id', 'component'])
			->whereIn('component_category_id', $descendants)
			->get();
	}

	public function getNewest()
	{
		return Component::with('category')
			->latest()
			->limit(10)
			->get();

	}

	public function search($needle='')
	{
		$components = Component::where('component', 'like', $needle . '%')
			->orderBy('component')
			->limit(5)
			->get();

		$results = [];

		foreach($components as $component)
		{
			$results[] = [
				'id'        => $component->id,
				'component' => $component->component,
				'picture'   => $component->picture,
				'sketches'  => $component->references->count(),
				'url'       => route('components.show', [$component->id])
			];
		}

		return $results;

	}

	public function incrementViews(Component $component)
	{
		return $component->increment('views');
	}

	public function getWeekCreatedCount()
	{
		return Component::where('created_at', '>=', Carbon::now()->subWeek())
			->count();
	}

	/**
	 * @param StoreComponentRequest $request
	 * @return Board
	 */
	public function create(StoreComponentRequest $request)
	{
		$component = new Component();

		return $this->update($component, $request);
	}

	public function update(Component $component, StoreComponentRequest $request)
	{
		$inputs = $request->input();

		if(empty($inputs['manufacturer_id']))
		{
			unset($inputs['manufacturer_id']);
		}

		$component->fill($inputs);

		$component->save();

		$this->moveUploadedImage($component, $request);

		return $component;
	}



	/*
	 * Categories
	 */

	public function getCategoriesList($separator = ' ')
	{
		return ComponentCategory::getNestedList('category', NULL, $separator);
	}

	public function createCategory(StoreComponentCategoryRequest $request)
	{
		$component_category = new ComponentCategory();

		return $this->updateCategory($component_category, $request);
	}

	public function updateCategory(ComponentCategory $component_category, StoreComponentCategoryRequest $request)
	{
		$inputs = $request->input();

		$parent = ComponentCategory::find($inputs['parent_id']);

		$component_category->category = $inputs['category'];

		$component_category->save();

		$component_category->makeChildOf($parent);

		return $component_category;
	}

}