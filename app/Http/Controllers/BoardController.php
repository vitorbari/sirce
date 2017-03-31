<?php namespace Sirce\Http\Controllers;

use SEO;

use Sirce\Http\Requests;
use Sirce\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Sirce\Http\Requests\StoreBoardRequest;
use Sirce\Models\Board;
use Sirce\Repositories\BoardRepository;
use Sirce\Repositories\ManufacturerRepository;
use Sirce\Repositories\McuRepository;

class BoardController extends Controller
{


	/**
	 * @var BoardRepository
	 */
	private $boardRepository;
	/**
	 * @var ManufacturerRepository
	 */
	private $manufacturerRepository;
	/**
	 * @var McuRepository
	 */
	private $mcuRepository;

	function __construct(BoardRepository $boardRepository,
						 ManufacturerRepository $manufacturerRepository,
						 McuRepository $mcuRepository)
	{
		$this->boardRepository = $boardRepository;
		$this->manufacturerRepository = $manufacturerRepository;
		$this->mcuRepository = $mcuRepository;

		$this->middleware('admin', ['except' => ['index', 'show']]);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function index(Request $request)
	{
		SEO::setTitle('Boards');
		SEO::setDescription('List of microcontroller boards');

		$fields = ['board', 'board_family_id', 'manufacturer_id'];

		// filter
		$board_families = ['' => '(any)'] + $this->boardRepository->listFamilies();
		$manufacturers  = ['' => '(any)'] + $this->manufacturerRepository->lists();

		$boards = $this->boardRepository->getPaginated($request->only($fields));

		return view('boards.index', compact(
			'boards',
			'board_families',
			'manufacturers',
			'fields'
		));
	}

	public function create()
	{
		$board_families = ['' => ''] + $this->boardRepository->listFamilies();
		$manufacturers  = ['' => ''] + $this->manufacturerRepository->lists();
		$mcus  = ['' => ''] + $this->mcuRepository->lists();

		$form_route = 'boards.store';

		return view('boards.edit', compact(
			'form_route',
			'board_families',
			'manufacturers',
			'mcus'
		));
	}

	public function store(StoreBoardRequest $request)
	{
		$board = $this->boardRepository->create($request);

		flash()->success('Board created!');

		return redirect()->route('boards.show', $board->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Board $board
	 *
	 * @return Response
	 */
	public function show(Board $board)
	{
		SEO::setTitle($board->board);
		SEO::setDescription('Board ' . $board->board . ' details and sketches');

		$this->boardRepository->incrementViews($board);

		$comments_section = TRUE;

		return view('boards.show', compact('board', 'comments_section'));
	}

	public function edit(Board $board)
	{
		$board_families = ['' => ''] + $this->boardRepository->listFamilies();
		$manufacturers  = ['' => ''] + $this->manufacturerRepository->lists();
		$mcus  = ['' => ''] + $this->mcuRepository->lists();

		$form_route = 'boards.update';

		return view('boards.edit', compact(
			'board',
			'form_route',
			'board_families',
			'manufacturers',
			'mcus'
		));
	}

	public function update(Board $board, StoreBoardRequest $request)
	{
		$board = $this->boardRepository->update($board, $request);

		flash()->success('Board updated!');

		return redirect()->route('boards.show', $board->id);
	}

	public function destroy(Board $board)
	{

	}

}
