<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Mitul\Controller\AppBaseController;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\items;
use Illuminate\Http\Request;
use App\Libraries\Repositories\itemsRepository;
use Response;
use Schema;

class itemsAPIController extends AppBaseController
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

		return Response::json(ResponseManager::makeResult($items->toArray(), "items retrieved successfully."));
	}

	public function search($input)
    {
        $query = items::query();

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
	 * Show the form for creating a new items.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created items in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(items::$rules) > 0)
            $this->validateRequest($request, items::$rules);

        $input = $request->all();

		$items = $this->itemsRepository->store($input);

		return Response::json(ResponseManager::makeResult($items->toArray(), "items saved successfully."));
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
			$this->throwRecordNotFoundException("items not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($items->toArray(), "items retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified items.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified items in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$items = $this->itemsRepository->finditemsById($id);

		if(empty($items))
			$this->throwRecordNotFoundException("items not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$items = $this->itemsRepository->update($items, $input);

		return Response::json(ResponseManager::makeResult($items->toArray(), "items updated successfully."));
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
			$this->throwRecordNotFoundException("items not found", ERROR_CODE_RECORD_NOT_FOUND);

		$items->delete();

		return Response::json(ResponseManager::makeResult($id, "items deleted successfully."));
	}
}
