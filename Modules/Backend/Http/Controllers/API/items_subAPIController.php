<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Mitul\Controller\AppBaseController;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\items_sub;
use Illuminate\Http\Request;
use App\Libraries\Repositories\items_subRepository;
use Response;
use Schema;

class items_subAPIController extends AppBaseController
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

		return Response::json(ResponseManager::makeResult($itemsSubs->toArray(), "items_subs retrieved successfully."));
	}

	public function search($input)
    {
        $query = items_sub::query();

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
	 * Show the form for creating a new items_sub.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created items_sub in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(items_sub::$rules) > 0)
            $this->validateRequest($request, items_sub::$rules);

        $input = $request->all();

		$itemsSub = $this->itemsSubRepository->store($input);

		return Response::json(ResponseManager::makeResult($itemsSub->toArray(), "items_sub saved successfully."));
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
			$this->throwRecordNotFoundException("items_sub not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($itemsSub->toArray(), "items_sub retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified items_sub.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified items_sub in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$itemsSub = $this->itemsSubRepository->finditems_subById($id);

		if(empty($itemsSub))
			$this->throwRecordNotFoundException("items_sub not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$itemsSub = $this->itemsSubRepository->update($itemsSub, $input);

		return Response::json(ResponseManager::makeResult($itemsSub->toArray(), "items_sub updated successfully."));
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
			$this->throwRecordNotFoundException("items_sub not found", ERROR_CODE_RECORD_NOT_FOUND);

		$itemsSub->delete();

		return Response::json(ResponseManager::makeResult($id, "items_sub deleted successfully."));
	}
}
