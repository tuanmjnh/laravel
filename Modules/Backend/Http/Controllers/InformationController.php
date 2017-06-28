<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateinformationRequest;
use Illuminate\Http\Request;
use App\Libraries\Repositories\informationRepository;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;

class InformationController extends AppBaseController
{

	/** @var  informationRepository */
	private $informationRepository;

	function __construct(informationRepository $informationRepo)
	{
		$this->informationRepository = $informationRepo;
	}

	/**
	 * Display a listing of the information.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->informationRepository->search($input);

		$information = $result[0];

		$attributes = $result[1];

		return view('information.index')
		    ->with('information', $information)
		    ->with('attributes', $attributes);;
	}

	/**
	 * Show the form for creating a new information.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('information.create');
	}

	/**
	 * Store a newly created information in storage.
	 *
	 * @param CreateinformationRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateinformationRequest $request)
	{
        $input = $request->all();

		$information = $this->informationRepository->store($input);

		Flash::message('information saved successfully.');

		return redirect(route('information.index'));
	}

	/**
	 * Display the specified information.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$information = $this->informationRepository->findinformationById($id);

		if(empty($information))
		{
			Flash::error('information not found');
			return redirect(route('information.index'));
		}

		return view('information.show')->with('information', $information);
	}

	/**
	 * Show the form for editing the specified information.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$information = $this->informationRepository->findinformationById($id);

		if(empty($information))
		{
			Flash::error('information not found');
			return redirect(route('information.index'));
		}

		return view('information.edit')->with('information', $information);
	}

	/**
	 * Update the specified information in storage.
	 *
	 * @param  int    $id
	 * @param CreateinformationRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreateinformationRequest $request)
	{
		$information = $this->informationRepository->findinformationById($id);

		if(empty($information))
		{
			Flash::error('information not found');
			return redirect(route('information.index'));
		}

		$information = $this->informationRepository->update($information, $request->all());

		Flash::message('information updated successfully.');

		return redirect(route('information.index'));
	}

	/**
	 * Remove the specified information from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$information = $this->informationRepository->findinformationById($id);

		if(empty($information))
		{
			Flash::error('information not found');
			return redirect(route('information.index'));
		}

		$information->delete();

		Flash::message('information deleted successfully.');

		return redirect(route('information.index'));
	}

}
