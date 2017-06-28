<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Createitems_subRequest;
use Illuminate\Http\Request;
use App\Libraries\Repositories\items_subRepository;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;

class Items_subController extends AppBaseController
{

	/** @var  items_subRepository */
	private $itemsSubRepository;

	function __construct(items_subRepository $itemsSubRepo)
	{
		$this->itemsSubRepository = $itemsSubRepo;
	}

	/**
	 * Display a listing of the items_sub.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->itemsSubRepository->search($input);

		$itemsSubs = $result[0];

		$attributes = $result[1];

		return view('itemsSubs.index')
		    ->with('itemsSubs', $itemsSubs)
		    ->with('attributes', $attributes);;
	}

	/**
	 * Show the form for creating a new items_sub.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('itemsSubs.create');
	}

	/**
	 * Store a newly created items_sub in storage.
	 *
	 * @param Createitems_subRequest $request
	 *
	 * @return Response
	 */
	public function store(Createitems_subRequest $request)
	{
        $input = $request->all();

		$itemsSub = $this->itemsSubRepository->store($input);

		Flash::message('items_sub saved successfully.');

		return redirect(route('itemsSubs.index'));
	}

	/**
	 * Display the specified items_sub.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$itemsSub = $this->itemsSubRepository->finditems_subById($id);

		if(empty($itemsSub))
		{
			Flash::error('items_sub not found');
			return redirect(route('itemsSubs.index'));
		}

		return view('itemsSubs.show')->with('itemsSub', $itemsSub);
	}

	/**
	 * Show the form for editing the specified items_sub.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$itemsSub = $this->itemsSubRepository->finditems_subById($id);

		if(empty($itemsSub))
		{
			Flash::error('items_sub not found');
			return redirect(route('itemsSubs.index'));
		}

		return view('itemsSubs.edit')->with('itemsSub', $itemsSub);
	}

	/**
	 * Update the specified items_sub in storage.
	 *
	 * @param  int    $id
	 * @param Createitems_subRequest $request
	 *
	 * @return Response
	 */
	public function update($id, Createitems_subRequest $request)
	{
		$itemsSub = $this->itemsSubRepository->finditems_subById($id);

		if(empty($itemsSub))
		{
			Flash::error('items_sub not found');
			return redirect(route('itemsSubs.index'));
		}

		$itemsSub = $this->itemsSubRepository->update($itemsSub, $request->all());

		Flash::message('items_sub updated successfully.');

		return redirect(route('itemsSubs.index'));
	}

	/**
	 * Remove the specified items_sub from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$itemsSub = $this->itemsSubRepository->finditems_subById($id);

		if(empty($itemsSub))
		{
			Flash::error('items_sub not found');
			return redirect(route('itemsSubs.index'));
		}

		$itemsSub->delete();

		Flash::message('items_sub deleted successfully.');

		return redirect(route('itemsSubs.index'));
	}

}
