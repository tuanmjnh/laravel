<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Mitul\Controller\AppBaseController;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\language_key;
use Illuminate\Http\Request;
use App\Libraries\Repositories\language_keyRepository;
use Response;
use Schema;

class language_keyAPIController extends AppBaseController
{

	/** @var  language_keyRepository */
	private $languageKeyRepository;

	function __construct(language_keyRepository $languageKeyRepo)
	{
		$this->languageKeyRepository = $languageKeyRepo;
	}

	/**
	 * Display a listing of the language_key.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->languageKeyRepository->search($input);

		$languageKeys = $result[0];

		return Response::json(ResponseManager::makeResult($languageKeys->toArray(), "language_keys retrieved successfully."));
	}

	public function search($input)
    {
        $query = language_key::query();

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
	 * Show the form for creating a new language_key.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created language_key in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(language_key::$rules) > 0)
            $this->validateRequest($request, language_key::$rules);

        $input = $request->all();

		$languageKey = $this->languageKeyRepository->store($input);

		return Response::json(ResponseManager::makeResult($languageKey->toArray(), "language_key saved successfully."));
	}

	/**
	 * Display the specified language_key.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$languageKey = $this->languageKeyRepository->findlanguage_keyById($id);

		if(empty($languageKey))
			$this->throwRecordNotFoundException("language_key not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($languageKey->toArray(), "language_key retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified language_key.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified language_key in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$languageKey = $this->languageKeyRepository->findlanguage_keyById($id);

		if(empty($languageKey))
			$this->throwRecordNotFoundException("language_key not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$languageKey = $this->languageKeyRepository->update($languageKey, $input);

		return Response::json(ResponseManager::makeResult($languageKey->toArray(), "language_key updated successfully."));
	}

	/**
	 * Remove the specified language_key from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$languageKey = $this->languageKeyRepository->findlanguage_keyById($id);

		if(empty($languageKey))
			$this->throwRecordNotFoundException("language_key not found", ERROR_CODE_RECORD_NOT_FOUND);

		$languageKey->delete();

		return Response::json(ResponseManager::makeResult($id, "language_key deleted successfully."));
	}
}
