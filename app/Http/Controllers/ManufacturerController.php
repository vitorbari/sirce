<?php namespace Sirce\Http\Controllers;

use SEO;

use Sirce\Http\Requests;
use Sirce\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Sirce\Http\Requests\StoreManufacturerRequest;
use Sirce\Models\Manufacturer;
use Sirce\Repositories\ManufacturerRepository;

class ManufacturerController extends Controller
{
	/**
	 * @var ManufacturerRepository
	 */
	private $manufacturerRepository;

	function __construct(ManufacturerRepository $manufacturerRepository)
	{
		$this->manufacturerRepository = $manufacturerRepository;

		$this->middleware('admin', ['except' => ['index', 'show']]);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		SEO::setTitle('Manufacturers');
		SEO::setDescription('List of manufacturers');

		$manufacturers = $this->manufacturerRepository->getPaginated();

		return view('manufacturers.index', compact('manufacturers'));
	}

	public function create()
	{
		$form_route = 'manufacturers.store';

		return view('manufacturers.edit', compact(
			'form_route'
		));
	}

	public function store(StoreManufacturerRequest $request)
	{
		$manufacturer = $this->manufacturerRepository->create($request);

		flash()->success('Manufacturer created!');

		return redirect()->route('manufacturers.show', $manufacturer->id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Manufacturer $manufacturer
	 * @return Response
	 */
	public function show(Manufacturer $manufacturer)
	{
		SEO::setTitle($manufacturer->manufacturer);
		SEO::setDescription('Manufacturer '.$manufacturer->manufacturer.' details and pieces');

		$comments_section = TRUE;

		return view('manufacturers.show', compact('manufacturer', 'comments_section'));
	}

	public function edit(Manufacturer $manufacturer)
	{
		$form_route = 'manufacturers.update';

		return view('components.edit', compact(
			'manufacturer',
			'form_route'
		));
	}

	public function update(Manufacturer $manufacturer, StoreManufacturerRequest $request)
	{
		$manufacturer = $this->manufacturerRepository->update($manufacturer, $request);

		flash()->success('Manufacturer updated!');

		return redirect()->route('manufacturers.show', $manufacturer->id);
	}
}
