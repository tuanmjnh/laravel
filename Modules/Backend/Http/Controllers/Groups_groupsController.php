<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Creategroups_groupsRequest;
use Illuminate\Http\Request;
use App\Libraries\Repositories\groups_groupsRepository;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;

class Groups_groupsController extends AppBaseController
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

		$attributes = $result[1];

		return view('groupsGroups.index')
		    ->with('groupsGroups', $groupsGroups)
		    ->with('attributes', $attributes);;
	}

	/**
	 * Show the form for creating a new groups_groups.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('groupsGroups.create');
	}

	/**
	 * Store a newly created groups_groups in storage.
	 *
	 * @param Creategroups_groupsRequest $request
	 *
	 * @return Response
	 */
	public function store(Creategroups_groupsRequest $request)
	{
        $input = $request->all();

		$groupsGroups = $this->groupsGroupsRepository->store($input);

		Flash::message('groups_groups saved successfully.');

		return redirect(route('groupsGroups.index'));
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
		{
			Flash::error('groups_groups not found');
			return redirect(route('groupsGroups.index'));
		}

		return view('groupsGroups.show')->with('groupsGroups', $groupsGroups);
	}

	/**
	 * Show the form for editing the specified groups_groups.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$groupsGroups = $this->groupsGroupsRepository->findgroups_groupsById($id);

		if(empty($groupsGroups))
		{
			Flash::error('groups_groups not found');
			return redirect(route('groupsGroups.index'));
		}

		return view('groupsGroups.edit')->with('groupsGroups', $groupsGroups);
	}

	/**
	 * Update the specified groups_groups in storage.
	 *
	 * @param  int    $id
	 * @param Creategroups_groupsRequest $request
	 *
	 * @return Response
	 */
	public function update($id, Creategroups_groupsRequest $request)
	{
		$groupsGroups = $this->groupsGroupsRepository->findgroups_groupsById($id);

		if(empty($groupsGroups))
		{
			Flash::error('groups_groups not found');
			return redirect(route('groupsGroups.index'));
		}

		$groupsGroups = $this->groupsGroupsRepository->update($groupsGroups, $request->all());

		Flash::message('groups_groups updated successfully.');

		return redirect(route('groupsGroups.index'));
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
		{
			Flash::error('groups_groups not found');
			return redirect(route('groupsGroups.index'));
		}

		$groupsGroups->delete();

		Flash::message('groups_groups deleted successfully.');

		return redirect(route('groupsGroups.index'));
	}

}
