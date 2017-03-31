<?php namespace Sirce\Http\Controllers;

use SEO;

use Sirce\Http\Requests;
use Sirce\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Sirce\Http\Requests\StoreMCURequest;
use Sirce\Models\Mcu;
use Sirce\Repositories\ManufacturerRepository;
use Sirce\Repositories\McuRepository;

class McuController extends Controller {



	/**
	 * @var ManufacturerRepository
	 */
	private $manufacturerRepository;
	/**
	 * @var McuRepository
	 */
	private $mcuRepository;

	function __construct(McuRepository $mcuRepository,
						 ManufacturerRepository $manufacturerRepository)
	{
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
		SEO::setTitle('MCUs');
		SEO::setDescription('List of microcontrollers');

		$fields = ['mcu', 'mcu_family_id', 'manufacturer_id'];

		// filter
		$mcu_families = ['' => '(any)'] + $this->mcuRepository->listFamilies();
		$manufacturers  = ['' => '(any)'] + $this->manufacturerRepository->lists();

		$mcus = $this->mcuRepository->getPaginated($request->only($fields));

		return view('mcus.index', compact(
			'mcus',
			'mcu_families',
			'manufacturers',
			'fields'
		));
	}

	public function create()
	{
		$mcu_families = ['' => ''] + $this->mcuRepository->listFamilies();
		$manufacturers  = ['' => ''] + $this->manufacturerRepository->lists();

		$form_route = 'mcus.store';

		return view('mcus.edit', compact(
			'form_route',
			'mcu_families',
			'manufacturers'
		));
	}

	public function store(StoreMCURequest $request)
	{
		$mcu = $this->mcuRepository->create($request);

		flash()->success('MCU created!');

		return redirect()->route('mcus.show', $mcu->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param MCU $mcu
	 *
	 * @return Response
	 */
	public function show(MCU $mcu)
	{
		SEO::setTitle($mcu->mcu);
		SEO::setDescription('MCU ' . $mcu->mcu . ' details and sketches');

//		$this->mcuRepository->incrementViews($mcu);

		$comments_section = TRUE;

		return view('mcus.show', compact('mcu', 'comments_section'));
	}

	public function edit(MCU $mcu)
	{
		$mcu_families = ['' => ''] + $this->mcuRepository->listFamilies();
		$manufacturers  = ['' => ''] + $this->manufacturerRepository->lists();
		$mcus  = ['' => ''] + $this->mcuRepository->lists();

		$form_route = 'mcus.update';

		return view('mcus.edit', compact(
			'mcu',
			'form_route',
			'mcu_families',
			'manufacturers',
			'mcus'
		));
	}

	public function update(MCU $mcu, StoreMCURequest $request)
	{
		$mcu = $this->mcuRepository->update($mcu, $request);

		flash()->success('MCU updated!');

		return redirect()->route('mcus.show', $mcu->id);
	}

	public function destroy(MCU $mcu)
	{

	}

}
