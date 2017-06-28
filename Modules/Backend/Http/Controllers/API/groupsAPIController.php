<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Mitul\Controller\AppBaseController;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\groups;
use Illuminate\Http\Request;
use App\Libraries\Repositories\groupsRepository;
use Response;
use Schema;

class groupsAPIController extends AppBaseController
{

	/** @var  groupsRepository */
	private $groupsRepository;

	function __construct(groupsRepository $groupsRepo)
	{
		$this->groupsRepository = $groupsRepo;
	}

	/**
	 * Display a listing of the groups.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->groupsRepository->search($input);

		$groups = $result[0];

		return Response::json(ResponseManager::makeResult($groups->toArray(), "groups retrieved successfully."));
	}

	public function search($input)
    {
        $query = groups::query();

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
	 * Show the form for creating a new groups.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created groups in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(groups::$rules) > 0)
            $this->validateRequest($request, groups::$rules);

        $input = $request->all();

		$groups = $this->groupsRepository->store($input);

		return Response::json(ResponseManager::makeResult($groups->toArray(), "groups saved successfully."));
	}

	/**
	 * Display the specified groups.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$groups = $this->groupsRepository->findgroupsById($id);

		if(empty($groups))
			$this->throwRecordNotFoundException("groups not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($groups->toArray(), "groups retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified groups.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified groups in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$groups = $this->groupsRepository->findgroupsById($id);

		if(empty($groups))
			$this->throwRecordNotFoundException("groups not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$groups = $this->groupsRepository->update($groups, $input);

		return Response::json(ResponseManager::makeResult($groups->toArray(), "groups updated successfully."));
	}

	/**
	 * Remove the specified groups from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$groups = $this->groupsRepository->findgroupsById($id);

		if(empty($groups))
			$this->throwRecordNotFoundException("groups not found", ERROR_CODE_RECORD_NOT_FOUND);

		$groups->delete();

		return Response::json(ResponseManager::makeResult($id, "groups deleted successfully."));
	}
}
