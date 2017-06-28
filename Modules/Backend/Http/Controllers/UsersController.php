<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateusersRequest;
use Illuminate\Http\Request;
use App\Libraries\Repositories\usersRepository;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;

class UsersController extends AppBaseController
{

	/** @var  usersRepository */
	private $usersRepository;

	function __construct(usersRepository $usersRepo)
	{
		$this->usersRepository = $usersRepo;
	}

	/**
	 * Display a listing of the users.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->usersRepository->search($input);

		$users = $result[0];

		$attributes = $result[1];

		return view('users.index')
		    ->with('users', $users)
		    ->with('attributes', $attributes);;
	}

	/**
	 * Show the form for creating a new users.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('users.create');
	}

	/**
	 * Store a newly created users in storage.
	 *
	 * @param CreateusersRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateusersRequest $request)
	{
        $input = $request->all();

		$users = $this->usersRepository->store($input);

		Flash::message('users saved successfully.');

		return redirect(route('users.index'));
	}

	/**
	 * Display the specified users.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$users = $this->usersRepository->findusersById($id);

		if(empty($users))
		{
			Flash::error('users not found');
			return redirect(route('users.index'));
		}

		return view('users.show')->with('users', $users);
	}

	/**
	 * Show the form for editing the specified users.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$users = $this->usersRepository->findusersById($id);

		if(empty($users))
		{
			Flash::error('users not found');
			return redirect(route('users.index'));
		}

		return view('users.edit')->with('users', $users);
	}

	/**
	 * Update the specified users in storage.
	 *
	 * @param  int    $id
	 * @param CreateusersRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreateusersRequest $request)
	{
		$users = $this->usersRepository->findusersById($id);

		if(empty($users))
		{
			Flash::error('users not found');
			return redirect(route('users.index'));
		}

		$users = $this->usersRepository->update($users, $request->all());

		Flash::message('users updated successfully.');

		return redirect(route('users.index'));
	}

	/**
	 * Remove the specified users from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$users = $this->usersRepository->findusersById($id);

		if(empty($users))
		{
			Flash::error('users not found');
			return redirect(route('users.index'));
		}

		$users->delete();

		Flash::message('users deleted successfully.');

		return redirect(route('users.index'));
	}

}
