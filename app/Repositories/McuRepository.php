<?php namespace Sirce\Repositories;

use Sirce\Http\Requests\StoreMCURequest;
use Sirce\Models\Mcu;
use Sirce\Models\McuFamily;
use Sirce\Repositories\Traits\ImageUploadTrait;

class McuRepository
{

	use ImageUploadTrait;

	public function getPaginated($params = [])
	{
		$boards = Mcu::orderBy('mcu');

		foreach ($params as $field => $value) {
			if (!empty($value)) {
				switch ($field) {
					case 'mcu':
						$boards = $boards->where($field, 'like', $value . '%');
						break;

					case 'board_family_id':
					case 'manufacturer_id':
						$boards = $boards->where($field, $value);
						break;
				}
			}
		}

		return $boards->paginate(16);
	}

	public function getAll()
	{
		return Mcu::with('family')
			->get();
	}

	public function lists()
	{
		return Mcu::orderBy('mcu')->lists('mcu', 'id');
	}

	public function getFamilies()
	{
		return McuFamily::has('mcus')
            ->orderBy('mcu_family')
			->get();
	}

	public function listFamilies()
	{
		return McuFamily::lists('mcu_family', 'id');
	}

	public function incrementViews(Mcu $board)
	{
		return $board->increment('views');
	}

	public function getMostViewed()
	{
		return Mcu::with('manufacturer')
			->orderBy('views', 'desc')
			->limit(5)
			->get();
	}

	public function search($needle='')
	{
		$mcus = Mcu::with('manufacturer')
			->where('mcu', 'like', $needle . '%')
			->orderBy('mcu')
			->limit(5)
			->get();

		$results = [];

		foreach($mcus as $mcu)
		{
			$results[] = [
				'id' => $mcu->id,
				'mcu' => $mcu->mcu,
				'picture' => $mcu->picture,
				'manufacturer' => $mcu->manufacturer->manufacturer,
				'url' => route('mcus.show', [$mcu->id])
			];
		}

		return $results;

	}


	/**
	 * @param StoreMCURequest $request
	 * @return Board
	 */
	public function create(StoreMCURequest $request)
	{
		$mcu = new MCU();

		return $this->update($mcu, $request);
	}

	public function update(MCU $mcu, StoreMCURequest $request)
	{
		$inputs = $request->input();

		$mcu->fill($inputs);

		$mcu->save();

		$this->moveUploadedImage($mcu, $request);

		return $mcu;
	}
}