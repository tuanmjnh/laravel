<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Mitul\Controller\AppBaseController;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\members;
use Illuminate\Http\Request;
use App\Libraries\Repositories\membersRepository;
use Response;
use Schema;

class membersAPIController extends AppBaseController
{

	/** @var  membersRepository */
	private $membersRepository;

	function __construct(membersRepository $membersRepo)
	{
		$this->membersRepository = $membersRepo;
	}

	/**
	 * Display a listing of the members.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->membersRepository->search($input);

		$members = $result[0];

		return Response::json(ResponseManager::makeResult($members->toArray(), "members retrieved successfully."));
	}

	public function search($input)
    {
        $query = members::query();

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
	 * Show the form for creating a new members.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created members in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(members::$rules) > 0)
            $this->validateRequest($request, members::$rules);

        $input = $request->all();

		$members = $this->membersRepository->store($input);

		return Response::json(ResponseManager::makeResult($members->toArray(), "members saved successfully."));
	}

	/**
	 * Display the specified members.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$members = $this->membersRepository->findmembersById($id);

		if(empty($members))
			$this->throwRecordNotFoundException("members not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($members->toArray(), "members retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified members.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified members in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$members = $this->membersRepository->findmembersById($id);

		if(empty($members))
			$this->throwRecordNotFoundException("members not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$members = $this->membersRepository->update($members, $input);

		return Response::json(ResponseManager::makeResult($members->toArray(), "members updated successfully."));
	}

	/**
	 * Remove the specified members from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$members = $this->membersRepository->findmembersById($id);

		if(empty($members))
			$this->throwRecordNotFoundException("members not found", ERROR_CODE_RECORD_NOT_FOUND);

		$members->delete();

		return Response::json(ResponseManager::makeResult($id, "members deleted successfully."));
	}
}
