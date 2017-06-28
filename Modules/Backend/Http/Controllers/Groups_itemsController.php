<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Creategroups_itemsRequest;
use Illuminate\Http\Request;
use App\Libraries\Repositories\groups_itemsRepository;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;

class Groups_itemsController extends AppBaseController
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

		$attributes = $result[1];

		return view('groupsItems.index')
		    ->with('groupsItems', $groupsItems)
		    ->with('attributes', $attributes);;
	}

	/**
	 * Show the form for creating a new groups_items.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('groupsItems.create');
	}

	/**
	 * Store a newly created groups_items in storage.
	 *
	 * @param Creategroups_itemsRequest $request
	 *
	 * @return Response
	 */
	public function store(Creategroups_itemsRequest $request)
	{
        $input = $request->all();

		$groupsItems = $this->groupsItemsRepository->store($input);

		Flash::message('groups_items saved successfully.');

		return redirect(route('groupsItems.index'));
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
		{
			Flash::error('groups_items not found');
			return redirect(route('groupsItems.index'));
		}

		return view('groupsItems.show')->with('groupsItems', $groupsItems);
	}

	/**
	 * Show the form for editing the specified groups_items.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$groupsItems = $this->groupsItemsRepository->findgroups_itemsById($id);

		if(empty($groupsItems))
		{
			Flash::error('groups_items not found');
			return redirect(route('groupsItems.index'));
		}

		return view('groupsItems.edit')->with('groupsItems', $groupsItems);
	}

	/**
	 * Update the specified groups_items in storage.
	 *
	 * @param  int    $id
	 * @param Creategroups_itemsRequest $request
	 *
	 * @return Response
	 */
	public function update($id, Creategroups_itemsRequest $request)
	{
		$groupsItems = $this->groupsItemsRepository->findgroups_itemsById($id);

		if(empty($groupsItems))
		{
			Flash::error('groups_items not found');
			return redirect(route('groupsItems.index'));
		}

		$groupsItems = $this->groupsItemsRepository->update($groupsItems, $request->all());

		Flash::message('groups_items updated successfully.');

		return redirect(route('groupsItems.index'));
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
		{
			Flash::error('groups_items not found');
			return redirect(route('groupsItems.index'));
		}

		$groupsItems->delete();

		Flash::message('groups_items deleted successfully.');

		return redirect(route('groupsItems.index'));
	}

}
