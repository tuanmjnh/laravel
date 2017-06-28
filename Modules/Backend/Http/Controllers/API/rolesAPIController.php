<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Mitul\Controller\AppBaseController;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\roles;
use Illuminate\Http\Request;
use App\Libraries\Repositories\rolesRepository;
use Response;
use Schema;

class rolesAPIController extends AppBaseController
{

	/** @var  rolesRepository */
	private $rolesRepository;

	function __construct(rolesRepository $rolesRepo)
	{
		$this->rolesRepository = $rolesRepo;
	}

	/**
	 * Display a listing of the roles.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->rolesRepository->search($input);

		$roles = $result[0];

		return Response::json(ResponseManager::makeResult($roles->toArray(), "roles retrieved successfully."));
	}

	public function search($input)
    {
        $query = roles::query();

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
	 * Show the form for creating a new roles.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created roles in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(roles::$rules) > 0)
            $this->validateRequest($request, roles::$rules);

        $input = $request->all();

		$roles = $this->rolesRepository->store($input);

		return Response::json(ResponseManager::makeResult($roles->toArray(), "roles saved successfully."));
	}

	/**
	 * Display the specified roles.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$roles = $this->rolesRepository->findrolesById($id);

		if(empty($roles))
			$this->throwRecordNotFoundException("roles not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($roles->toArray(), "roles retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified roles.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified roles in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$roles = $this->rolesRepository->findrolesById($id);

		if(empty($roles))
			$this->throwRecordNotFoundException("roles not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$roles = $this->rolesRepository->update($roles, $input);

		return Response::json(ResponseManager::makeResult($roles->toArray(), "roles updated successfully."));
	}

	/**
	 * Remove the specified roles from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$roles = $this->rolesRepository->findrolesById($id);

		if(empty($roles))
			$this->throwRecordNotFoundException("roles not found", ERROR_CODE_RECORD_NOT_FOUND);

		$roles->delete();

		return Response::json(ResponseManager::makeResult($id, "roles deleted successfully."));
	}
}
