<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Mitul\Controller\AppBaseController;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\groups_groups;
use Illuminate\Http\Request;
use App\Libraries\Repositories\groups_groupsRepository;
use Response;
use Schema;

class groups_groupsAPIController extends AppBaseController
{

	/** @var  groups_groupsRepository */
	private $groupsGroupsRepository;

	function __construct(groups_groupsRepository $groupsGroupsRepo)
	{
		$this->groupsGroupsRepository = $groupsGroupsRepo;
	}

	/**
	 * Display a listing of the groups_groups.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->groupsGroupsRepository->search($input);

		$groupsGroups = $result[0];

		return Response::json(ResponseManager::makeResult($groupsGroups->toArray(), "groups_groups retrieved successfully."));
	}

	public function search($input)
    {
        $query = groups_groups::query();

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
	 * Show the form for creating a new groups_groups.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created groups_groups in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(groups_groups::$rules) > 0)
            $this->validateRequest($request, groups_groups::$rules);

        $input = $request->all();

		$groupsGroups = $this->groupsGroupsRepository->store($input);

		return Response::json(ResponseManager::makeResult($groupsGroups->toArray(), "groups_groups saved successfully."));
	}

	/**
	 * Display the specified groups_groups.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$groupsGroups = $this->groupsGroupsRepository->findgroups_groupsById($id);

		if(empty($groupsGroups))
			$this->throwRecordNotFoundException("groups_groups not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($groupsGroups->toArray(), "groups_groups retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified groups_groups.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified groups_groups in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$groupsGroups = $this->groupsGroupsRepository->findgroups_groupsById($id);

		if(empty($groupsGroups))
			$this->throwRecordNotFoundException("groups_groups not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$groupsGroups = $this->groupsGroupsRepository->update($groupsGroups, $input);

		return Response::json(ResponseManager::makeResult($groupsGroups->toArray(), "groups_groups updated successfully."));
	}

	/**
	 * Remove the specified groups_groups from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$groupsGroups = $this->groupsGroupsRepository->findgroups_groupsById($id);

		if(empty($groupsGroups))
			$this->throwRecordNotFoundException("groups_groups not found", ERROR_CODE_RECORD_NOT_FOUND);

		$groupsGroups->delete();

		return Response::json(ResponseManager::makeResult($id, "groups_groups deleted successfully."));
	}
}
