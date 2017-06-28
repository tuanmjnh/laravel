<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Mitul\Controller\AppBaseController;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\groups_items;
use Illuminate\Http\Request;
use App\Libraries\Repositories\groups_itemsRepository;
use Response;
use Schema;

class groups_itemsAPIController extends AppBaseController
{

	/** @var  groups_itemsRepository */
	private $groupsItemsRepository;

	function __construct(groups_itemsRepository $groupsItemsRepo)
	{
		$this->groupsItemsRepository = $groupsItemsRepo;
	}

	/**
	 * Display a listing of the groups_items.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->groupsItemsRepository->search($input);

		$groupsItems = $result[0];

		return Response::json(ResponseManager::makeResult($groupsItems->toArray(), "groups_items retrieved successfully."));
	}

	public function search($input)
    {
        $query = groups_items::query();

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
	 * Show the form for creating a new groups_items.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created groups_items in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(groups_items::$rules) > 0)
            $this->validateRequest($request, groups_items::$rules);

        $input = $request->all();

		$groupsItems = $this->groupsItemsRepository->store($input);

		return Response::json(ResponseManager::makeResult($groupsItems->toArray(), "groups_items saved successfully."));
	}

	/**
	 * Display the specified groups_items.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$groupsItems = $this->groupsItemsRepository->findgroups_itemsById($id);

		if(empty($groupsItems))
			$this->throwRecordNotFoundException("groups_items not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($groupsItems->toArray(), "groups_items retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified groups_items.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified groups_items in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$groupsItems = $this->groupsItemsRepository->findgroups_itemsById($id);

		if(empty($groupsItems))
			$this->throwRecordNotFoundException("groups_items not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$groupsItems = $this->groupsItemsRepository->update($groupsItems, $input);

		return Response::json(ResponseManager::makeResult($groupsItems->toArray(), "groups_items updated successfully."));
	}

	/**
	 * Remove the specified groups_items from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$groupsItems = $this->groupsItemsRepository->findgroups_itemsById($id);

		if(empty($groupsItems))
			$this->throwRecordNotFoundException("groups_items not found", ERROR_CODE_RECORD_NOT_FOUND);

		$groupsItems->delete();

		return Response::json(ResponseManager::makeResult($id, "groups_items deleted successfully."));
	}
}
