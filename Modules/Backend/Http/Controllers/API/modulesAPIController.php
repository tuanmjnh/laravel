<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Mitul\Controller\AppBaseController;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\modules;
use Illuminate\Http\Request;
use App\Libraries\Repositories\modulesRepository;
use Response;
use Schema;

class modulesAPIController extends AppBaseController
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

		return Response::json(ResponseManager::makeResult($modules->toArray(), "modules retrieved successfully."));
	}

	public function search($input)
    {
        $query = modules::query();

        $columns = Schema::getColumnListing('$TABLE_NAME$');
        $attributes = array();

        foreach($columns as $attribute)
        {
            if(isset($input[$attribute]))
            {
                $query->where($attribute, $input[$attribute]);
            }
        }

        return $query->get();
    }

	/**
	 * Show the form for creating a new modules.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created modules in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(modules::$rules) > 0)
            $this->validateRequest($request, modules::$rules);

        $input = $request->all();

		$modules = $this->modulesRepository->store($input);

		return Response::json(ResponseManager::makeResult($modules->toArray(), "modules saved successfully."));
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
			$this->throwRecordNotFoundException("modules not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($modules->toArray(), "modules retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified modules.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified modules in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$modules = $this->modulesRepository->findmodulesById($id);

		if(empty($modules))
			$this->throwRecordNotFoundException("modules not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$modules = $this->modulesRepository->update($modules, $input);

		return Response::json(ResponseManager::makeResult($modules->toArray(), "modules updated successfully."));
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
			$this->throwRecordNotFoundException("modules not found", ERROR_CODE_RECORD_NOT_FOUND);

		$modules->delete();

		return Response::json(ResponseManager::makeResult($id, "modules deleted successfully."));
	}
}
