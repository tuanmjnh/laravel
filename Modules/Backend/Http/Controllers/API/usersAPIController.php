<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Mitul\Controller\AppBaseController;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\users;
use Illuminate\Http\Request;
use App\Libraries\Repositories\usersRepository;
use Response;
use Schema;

class usersAPIController extends AppBaseController
{

	/** @var  usersRepository */
	private $usersRepository;

	function __construct(usersRepository $usersRepo)
	{
		$this->usersRepository = $usersRepo;
	}

	/**
	 * Display a listing of the users.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->usersRepository->search($input);

		$users = $result[0];

		return Response::json(ResponseManager::makeResult($users->toArray(), "users retrieved successfully."));
	}

	public function search($input)
    {
        $query = users::query();

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
	 * Show the form for creating a new users.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created users in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(users::$rules) > 0)
            $this->validateRequest($request, users::$rules);

        $input = $request->all();

		$users = $this->usersRepository->store($input);

		return Response::json(ResponseManager::makeResult($users->toArray(), "users saved successfully."));
	}

	/**
	 * Display the specified users.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$users = $this->usersRepository->findusersById($id);

		if(empty($users))
			$this->throwRecordNotFoundException("users not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($users->toArray(), "users retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified users.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified users in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$users = $this->usersRepository->findusersById($id);

		if(empty($users))
			$this->throwRecordNotFoundException("users not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$users = $this->usersRepository->update($users, $input);

		return Response::json(ResponseManager::makeResult($users->toArray(), "users updated successfully."));
	}

	/**
	 * Remove the specified users from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$users = $this->usersRepository->findusersById($id);

		if(empty($users))
			$this->throwRecordNotFoundException("users not found", ERROR_CODE_RECORD_NOT_FOUND);

		$users->delete();

		return Response::json(ResponseManager::makeResult($id, "users deleted successfully."));
	}
}
