<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Mitul\Controller\AppBaseController;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\language_items;
use Illuminate\Http\Request;
use App\Libraries\Repositories\language_itemsRepository;
use Response;
use Schema;

class language_itemsAPIController extends AppBaseController
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

		return Response::json(ResponseManager::makeResult($languageItems->toArray(), "language_items retrieved successfully."));
	}

	public function search($input)
    {
        $query = language_items::query();

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
	 * Show the form for creating a new language_items.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created language_items in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(language_items::$rules) > 0)
            $this->validateRequest($request, language_items::$rules);

        $input = $request->all();

		$languageItems = $this->languageItemsRepository->store($input);

		return Response::json(ResponseManager::makeResult($languageItems->toArray(), "language_items saved successfully."));
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
			$this->throwRecordNotFoundException("language_items not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($languageItems->toArray(), "language_items retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified language_items.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified language_items in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$languageItems = $this->languageItemsRepository->findlanguage_itemsById($id);

		if(empty($languageItems))
			$this->throwRecordNotFoundException("language_items not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$languageItems = $this->languageItemsRepository->update($languageItems, $input);

		return Response::json(ResponseManager::makeResult($languageItems->toArray(), "language_items updated successfully."));
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
			$this->throwRecordNotFoundException("language_items not found", ERROR_CODE_RECORD_NOT_FOUND);

		$languageItems->delete();

		return Response::json(ResponseManager::makeResult($id, "language_items deleted successfully."));
	}
}
