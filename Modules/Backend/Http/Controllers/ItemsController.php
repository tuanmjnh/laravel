<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateitemsRequest;
use Illuminate\Http\Request;
use App\Libraries\Repositories\itemsRepository;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;

class ItemsController extends AppBaseController
{

	/** @var  itemsRepository */
	private $itemsRepository;

	function __construct(itemsRepository $itemsRepo)
	{
		$this->itemsRepository = $itemsRepo;
	}

	/**
	 * Display a listing of the items.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->itemsRepository->search($input);

		$items = $result[0];

		$attributes = $result[1];

		return view('items.index')
		    ->with('items', $items)
		    ->with('attributes', $attributes);;
	}

	/**
	 * Show the form for creating a new items.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('items.create');
	}

	/**
	 * Store a newly created items in storage.
	 *
	 * @param CreateitemsRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateitemsRequest $request)
	{
        $input = $request->all();

		$items = $this->itemsRepository->store($input);

		Flash::message('items saved successfully.');

		return redirect(route('items.index'));
	}

	/**
	 * Display the specified items.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$items = $this->itemsRepository->finditemsById($id);

		if(empty($items))
		{
			Flash::error('items not found');
			return redirect(route('items.index'));
		}

		return view('items.show')->with('items', $items);
	}

	/**
	 * Show the form for editing the specified items.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$items = $this->itemsRepository->finditemsById($id);

		if(empty($items))
		{
			Flash::error('items not found');
			return redirect(route('items.index'));
		}

		return view('items.edit')->with('items', $items);
	}

	/**
	 * Update the specified items in storage.
	 *
	 * @param  int    $id
	 * @param CreateitemsRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreateitemsRequest $request)
	{
		$items = $this->itemsRepository->finditemsById($id);

		if(empty($items))
		{
			Flash::error('items not found');
			return redirect(route('items.index'));
		}

		$items = $this->itemsRepository->update($items, $request->all());

		Flash::message('items updated successfully.');

		return redirect(route('items.index'));
	}

	/**
	 * Remove the specified items from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$items = $this->itemsRepository->finditemsById($id);

		if(empty($items))
		{
			Flash::error('items not found');
			return redirect(route('items.index'));
		}

		$items->delete();

		Flash::message('items deleted successfully.');

		return redirect(route('items.index'));
	}

}
