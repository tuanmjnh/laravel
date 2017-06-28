<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Mitul\Controller\AppBaseController;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\setting;
use Illuminate\Http\Request;
use App\Libraries\Repositories\settingRepository;
use Response;
use Schema;

class settingAPIController extends AppBaseController
{

	/** @var  settingRepository */
	private $settingRepository;

	function __construct(settingRepository $settingRepo)
	{
		$this->settingRepository = $settingRepo;
	}

	/**
	 * Display a listing of the setting.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->settingRepository->search($input);

		$settings = $result[0];

		return Response::json(ResponseManager::makeResult($settings->toArray(), "settings retrieved successfully."));
	}

	public function search($input)
    {
        $query = setting::query();

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
	 * Show the form for creating a new setting.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created setting in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(setting::$rules) > 0)
            $this->validateRequest($request, setting::$rules);

        $input = $request->all();

		$setting = $this->settingRepository->store($input);

		return Response::json(ResponseManager::makeResult($setting->toArray(), "setting saved successfully."));
	}

	/**
	 * Display the specified setting.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$setting = $this->settingRepository->findsettingById($id);

		if(empty($setting))
			$this->throwRecordNotFoundException("setting not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($setting->toArray(), "setting retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified setting.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified setting in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$setting = $this->settingRepository->findsettingById($id);

		if(empty($setting))
			$this->throwRecordNotFoundException("setting not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$setting = $this->settingRepository->update($setting, $input);

		return Response::json(ResponseManager::makeResult($setting->toArray(), "setting updated successfully."));
	}

	/**
	 * Remove the specified setting from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$setting = $this->settingRepository->findsettingById($id);

		if(empty($setting))
			$this->throwRecordNotFoundException("setting not found", ERROR_CODE_RECORD_NOT_FOUND);

		$setting->delete();

		return Response::json(ResponseManager::makeResult($id, "setting deleted successfully."));
	}
}
