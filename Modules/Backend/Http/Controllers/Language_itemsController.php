<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Createlanguage_itemsRequest;
use Illuminate\Http\Request;
use App\Libraries\Repositories\language_itemsRepository;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;

class Language_itemsController extends AppBaseController
{

	/** @var  language_itemsRepository */
	private $languageItemsRepository;

	function __construct(language_itemsRepository $languageItemsRepo)
	{
		$this->languageItemsRepository = $languageItemsRepo;
	}

	/**
	 * Display a listing of the language_items.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->languageItemsRepository->search($input);

		$languageItems = $result[0];

		$attributes = $result[1];

		return view('languageItems.index')
		    ->with('languageItems', $languageItems)
		    ->with('attributes', $attributes);;
	}

	/**
	 * Show the form for creating a new language_items.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('languageItems.create');
	}

	/**
	 * Store a newly created language_items in storage.
	 *
	 * @param Createlanguage_itemsRequest $request
	 *
	 * @return Response
	 */
	public function store(Createlanguage_itemsRequest $request)
	{
        $input = $request->all();

		$languageItems = $this->languageItemsRepository->store($input);

		Flash::message('language_items saved successfully.');

		return redirect(route('languageItems.index'));
	}

	/**
	 * Display the specified language_items.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$languageItems = $this->languageItemsRepository->findlanguage_itemsById($id);

		if(empty($languageItems))
		{
			Flash::error('language_items not found');
			return redirect(route('languageItems.index'));
		}

		return view('languageItems.show')->with('languageItems', $languageItems);
	}

	/**
	 * Show the form for editing the specified language_items.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$languageItems = $this->languageItemsRepository->findlanguage_itemsById($id);

		if(empty($languageItems))
		{
			Flash::error('language_items not found');
			return redirect(route('languageItems.index'));
		}

		return view('languageItems.edit')->with('languageItems', $languageItems);
	}

	/**
	 * Update the specified language_items in storage.
	 *
	 * @param  int    $id
	 * @param Createlanguage_itemsRequest $request
	 *
	 * @return Response
	 */
	public function update($id, Createlanguage_itemsRequest $request)
	{
		$languageItems = $this->languageItemsRepository->findlanguage_itemsById($id);

		if(empty($languageItems))
		{
			Flash::error('language_items not found');
			return redirect(route('languageItems.index'));
		}

		$languageItems = $this->languageItemsRepository->update($languageItems, $request->all());

		Flash::message('language_items updated successfully.');

		return redirect(route('languageItems.index'));
	}

	/**
	 * Remove the specified language_items from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$languageItems = $this->languageItemsRepository->findlanguage_itemsById($id);

		if(empty($languageItems))
		{
			Flash::error('language_items not found');
			return redirect(route('languageItems.index'));
		}

		$languageItems->delete();

		Flash::message('language_items deleted successfully.');

		return redirect(route('languageItems.index'));
	}

}
