<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use Mitul\Controller\AppBaseController;
use Mitul\Generator\Utils\ResponseManager;
use App\Models\language;
use Illuminate\Http\Request;
use App\Libraries\Repositories\languageRepository;
use Response;
use Schema;

class languageAPIController extends AppBaseController
{

	/** @var  languageRepository */
	private $languageRepository;

	function __construct(languageRepository $languageRepo)
	{
		$this->languageRepository = $languageRepo;
	}

	/**
	 * Display a listing of the language.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->languageRepository->search($input);

		$languages = $result[0];

		return Response::json(ResponseManager::makeResult($languages->toArray(), "languages retrieved successfully."));
	}

	public function search($input)
    {
        $query = language::query();

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
	 * Show the form for creating a new language.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created language in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(sizeof(language::$rules) > 0)
            $this->validateRequest($request, language::$rules);

        $input = $request->all();

		$language = $this->languageRepository->store($input);

		return Response::json(ResponseManager::makeResult($language->toArray(), "language saved successfully."));
	}

	/**
	 * Display the specified language.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$language = $this->languageRepository->findlanguageById($id);

		if(empty($language))
			$this->throwRecordNotFoundException("language not found", ERROR_CODE_RECORD_NOT_FOUND);

		return Response::json(ResponseManager::makeResult($language->toArray(), "language retrieved successfully."));
	}

	/**
	 * Show the form for editing the specified language.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified language in storage.
	 *
	 * @param  int    $id
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$language = $this->languageRepository->findlanguageById($id);

		if(empty($language))
			$this->throwRecordNotFoundException("language not found", ERROR_CODE_RECORD_NOT_FOUND);

		$input = $request->all();

		$language = $this->languageRepository->update($language, $input);

		return Response::json(ResponseManager::makeResult($language->toArray(), "language updated successfully."));
	}

	/**
	 * Remove the specified language from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$language = $this->languageRepository->findlanguageById($id);

		if(empty($language))
			$this->throwRecordNotFoundException("language not found", ERROR_CODE_RECORD_NOT_FOUND);

		$language->delete();

		return Response::json(ResponseManager::makeResult($id, "language deleted successfully."));
	}
}
