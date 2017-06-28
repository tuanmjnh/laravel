<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreategroupsRequest;
use Illuminate\Http\Request;
use App\Libraries\Repositories\groupsRepository;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;

class GroupsController extends AppBaseController
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

		$attributes = $result[1];

		return view('groups.index')
		    ->with('groups', $groups)
		    ->with('attributes', $attributes);;
	}

	/**
	 * Show the form for creating a new groups.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('groups.create');
	}

	/**
	 * Store a newly created groups in storage.
	 *
	 * @param CreategroupsRequest $request
	 *
	 * @return Response
	 */
	public function store(CreategroupsRequest $request)
	{
        $input = $request->all();

		$groups = $this->groupsRepository->store($input);

		Flash::message('groups saved successfully.');

		return redirect(route('groups.index'));
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
		{
			Flash::error('groups not found');
			return redirect(route('groups.index'));
		}

		return view('groups.show')->with('groups', $groups);
	}

	/**
	 * Show the form for editing the specified groups.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$groups = $this->groupsRepository->findgroupsById($id);

		if(empty($groups))
		{
			Flash::error('groups not found');
			return redirect(route('groups.index'));
		}

		return view('groups.edit')->with('groups', $groups);
	}

	/**
	 * Update the specified groups in storage.
	 *
	 * @param  int    $id
	 * @param CreategroupsRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreategroupsRequest $request)
	{
		$groups = $this->groupsRepository->findgroupsById($id);

		if(empty($groups))
		{
			Flash::error('groups not found');
			return redirect(route('groups.index'));
		}

		$groups = $this->groupsRepository->update($groups, $request->all());

		Flash::message('groups updated successfully.');

		return redirect(route('groups.index'));
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
		{
			Flash::error('groups not found');
			return redirect(route('groups.index'));
		}

		$groups->delete();

		Flash::message('groups deleted successfully.');

		return redirect(route('groups.index'));
	}

}
