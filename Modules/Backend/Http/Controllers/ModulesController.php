<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreatemodulesRequest;
use Illuminate\Http\Request;
use App\Libraries\Repositories\modulesRepository;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;

class ModulesController extends AppBaseController
{

	/** @var  modulesRepository */
	private $modulesRepository;

	function __construct(modulesRepository $modulesRepo)
	{
		$this->modulesRepository = $modulesRepo;
	}

	/**
	 * Display a listing of the modules.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->modulesRepository->search($input);

		$modules = $result[0];

		$attributes = $result[1];

		return view('modules.index')
		    ->with('modules', $modules)
		    ->with('attributes', $attributes);;
	}

	/**
	 * Show the form for creating a new modules.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('modules.create');
	}

	/**
	 * Store a newly created modules in storage.
	 *
	 * @param CreatemodulesRequest $request
	 *
	 * @return Response
	 */
	public function store(CreatemodulesRequest $request)
	{
        $input = $request->all();

		$modules = $this->modulesRepository->store($input);

		Flash::message('modules saved successfully.');

		return redirect(route('modules.index'));
	}

	/**
	 * Display the specified modules.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$modules = $this->modulesRepository->findmodulesById($id);

		if(empty($modules))
		{
			Flash::error('modules not found');
			return redirect(route('modules.index'));
		}

		return view('modules.show')->with('modules', $modules);
	}

	/**
	 * Show the form for editing the specified modules.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$modules = $this->modulesRepository->findmodulesById($id);

		if(empty($modules))
		{
			Flash::error('modules not found');
			return redirect(route('modules.index'));
		}

		return view('modules.edit')->with('modules', $modules);
	}

	/**
	 * Update the specified modules in storage.
	 *
	 * @param  int    $id
	 * @param CreatemodulesRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreatemodulesRequest $request)
	{
		$modules = $this->modulesRepository->findmodulesById($id);

		if(empty($modules))
		{
			Flash::error('modules not found');
			return redirect(route('modules.index'));
		}

		$modules = $this->modulesRepository->update($modules, $request->all());

		Flash::message('modules updated successfully.');

		return redirect(route('modules.index'));
	}

	/**
	 * Remove the specified modules from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$modules = $this->modulesRepository->findmodulesById($id);

		if(empty($modules))
		{
			Flash::error('modules not found');
			return redirect(route('modules.index'));
		}

		$modules->delete();

		Flash::message('modules deleted successfully.');

		return redirect(route('modules.index'));
	}

}
