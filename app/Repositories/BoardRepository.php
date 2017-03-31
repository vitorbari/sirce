<?php namespace Sirce\Repositories;

use Sirce\Http\Requests\StoreBoardRequest;
use Sirce\Models\Board;
use Sirce\Models\BoardFamily;
use Sirce\Repositories\Traits\ImageUploadTrait;

class BoardRepository
{

	use ImageUploadTrait;

	public function getPaginated($params = [])
	{
		$boards = Board::orderBy('board');

		foreach ($params as $field => $value) {
			if (!empty($value)) {
				switch ($field) {
					case 'board':
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
		return Board::with('family')
			->get();
	}

	public function getFamilies()
	{
		return BoardFamily::has('boards')
            ->orderBy('board_family')
			->get();
	}

	public function listFamilies()
	{
		return BoardFamily::lists('board_family', 'id');
	}

	public function incrementViews(Board $board)
	{
		return $board->increment('views');
	}

	public function getMostViewed()
	{
		return Board::with('manufacturer')
			->orderBy('views', 'desc')
			->limit(5)
			->get();
	}

	public function search($needle='')
	{
		$boards = Board::with('manufacturer')
			->where('board', 'like', $needle . '%')
			->orderBy('board')
			->limit(5)
			->get();

		$results = [];

		foreach($boards as $board)
		{
			$results[] = [
				'id'           => $board->id,
				'board'        => $board->board,
				'picture'      => $board->picture,
				'manufacturer' => $board->manufacturer->manufacturer,
				'url'          => route('boards.show', [$board->id])
			];
		}

		return $results;

	}


	/**
	 * @param StoreBoardRequest $request
	 * @return Board
	 */
	public function create(StoreBoardRequest $request)
	{
		$board = new Board();

		return $this->update($board, $request);
	}

	public function update(Board $board, StoreBoardRequest $request)
	{
		$inputs = $request->input();

		$board->fill($inputs);

		$board->save();

		$this->moveUploadedImage($board, $request);

		return $board;
	}

}