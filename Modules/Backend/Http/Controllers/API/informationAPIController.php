<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Mitul\Controller\AppBaseController;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\information;
use Illuminate\Http\Request;
use App\Libraries\Repositories\informationRepository;
use Response;
use Schema;

class informationAPIController extends AppBaseController
{

	/** @var  informationRepository */
	private $informationRepository;

	function __construct(informationRepository $informationRepo)
	{
		$this->informationRepository = $informationRepo;
	}

	/**
	 * Display a listing of the information.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->informationRepository->search($input);

		$information = $result[0];

		return Response::json(ResponseManager::makeResult($information->toArray(), "information retrieved successfully."));
	}

	public function search($input)
    {
        $query = information::query();

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
	 * Show the form for creating a new information.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created information in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(information::$rules) > 0)
            $this->validateRequest($request, information::$rules);

        $input = $request->all();

		$information = $this->informationRepository->store($input);

		return Response::json(ResponseManager::makeResult($information->toArray(), "information saved successfully."));
	}

	/**
	 * Display the specified information.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$information = $this->informationRepository->findinformationById($id);

		if(empty($information))
			$this->throwRecordNotFoundException("information not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($information->toArray(), "information retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified information.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified information in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$information = $this->informationRepository->findinformationById($id);

		if(empty($information))
			$this->throwRecordNotFoundException("information not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$information = $this->informationRepository->update($information, $input);

		return Response::json(ResponseManager::makeResult($information->toArray(), "information updated successfully."));
	}

	/**
	 * Remove the specified information from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$information = $this->informationRepository->findinformationById($id);

		if(empty($information))
			$this->throwRecordNotFoundException("information not found", ERROR_CODE_RECORD_NOT_FOUND);

		$information->delete();

		return Response::json(ResponseManager::makeResult($id, "information deleted successfully."));
	}
}
