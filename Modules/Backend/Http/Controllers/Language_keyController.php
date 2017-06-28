<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\Createlanguage_keyRequest;
use Illuminate\Http\Request;
use App\Libraries\Repositories\language_keyRepository;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;

class Language_keyController extends AppBaseController
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

		$attributes = $result[1];

		return view('languageKeys.index')
		    ->with('languageKeys', $languageKeys)
		    ->with('attributes', $attributes);;
	}

	/**
	 * Show the form for creating a new language_key.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('languageKeys.create');
	}

	/**
	 * Store a newly created language_key in storage.
	 *
	 * @param Createlanguage_keyRequest $request
	 *
	 * @return Response
	 */
	public function store(Createlanguage_keyRequest $request)
	{
        $input = $request->all();

		$languageKey = $this->languageKeyRepository->store($input);

		Flash::message('language_key saved successfully.');

		return redirect(route('languageKeys.index'));
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
		{
			Flash::error('language_key not found');
			return redirect(route('languageKeys.index'));
		}

		return view('languageKeys.show')->with('languageKey', $languageKey);
	}

	/**
	 * Show the form for editing the specified language_key.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$languageKey = $this->languageKeyRepository->findlanguage_keyById($id);

		if(empty($languageKey))
		{
			Flash::error('language_key not found');
			return redirect(route('languageKeys.index'));
		}

		return view('languageKeys.edit')->with('languageKey', $languageKey);
	}

	/**
	 * Update the specified language_key in storage.
	 *
	 * @param  int    $id
	 * @param Createlanguage_keyRequest $request
	 *
	 * @return Response
	 */
	public function update($id, Createlanguage_keyRequest $request)
	{
		$languageKey = $this->languageKeyRepository->findlanguage_keyById($id);

		if(empty($languageKey))
		{
			Flash::error('language_key not found');
			return redirect(route('languageKeys.index'));
		}

		$languageKey = $this->languageKeyRepository->update($languageKey, $request->all());

		Flash::message('language_key updated successfully.');

		return redirect(route('languageKeys.index'));
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
		{
			Flash::error('language_key not found');
			return redirect(route('languageKeys.index'));
		}

		$languageKey->delete();

		Flash::message('language_key deleted successfully.');

		return redirect(route('languageKeys.index'));
	}

}
