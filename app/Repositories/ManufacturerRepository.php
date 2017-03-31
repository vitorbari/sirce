<?php namespace Sirce\Repositories;

use Sirce\Http\Requests\StoreManufacturerRequest;
use Sirce\Models\Manufacturer;
use Sirce\Repositories\Traits\ImageUploadTrait;

class ManufacturerRepository
{

	use ImageUploadTrait;

	public function getPaginated()
	{
		return Manufacturer::orderBy('manufacturer')
			->paginate(16);
	}

	public function lists()
	{
		return Manufacturer::lists('manufacturer', 'id');
	}

	public function getAll()
	{
		return Manufacturer::orderBy('manufacturer')->get();
	}

	/**
	 * @param StoreManufacturerRequest $request
	 * @return Board
	 */
	public function create(StoreManufacturerRequest $request)
	{
		$manufacturer = new Manufacturer();

		return $this->update($manufacturer, $request);
	}

	public function update(Manufacturer $manufacturer, StoreManufacturerRequest $request)
	{
		$inputs = $request->input();

		$manufacturer->fill($inputs);

		$manufacturer->save();

		$this->moveUploadedImage($manufacturer, $request);

		return $manufacturer;
	}
}