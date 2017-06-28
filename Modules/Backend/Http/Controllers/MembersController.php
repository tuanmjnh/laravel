<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreatemembersRequest;
use Illuminate\Http\Request;
use App\Libraries\Repositories\membersRepository;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;

class MembersController extends AppBaseController
{

	/** @var  membersRepository */
	private $membersRepository;

	function __construct(membersRepository $membersRepo)
	{
		$this->membersRepository = $membersRepo;
	}

	/**
	 * Display a listing of the members.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
	    $input = $request->all();

		$result = $this->membersRepository->search($input);

		$members = $result[0];

		$attributes = $result[1];

		return view('members.index')
		    ->with('members', $members)
		    ->with('attributes', $attributes);;
	}

	/**
	 * Show the form for creating a new members.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('members.create');
	}

	/**
	 * Store a newly created members in storage.
	 *
	 * @param CreatemembersRequest $request
	 *
	 * @return Response
	 */
	public function store(CreatemembersRequest $request)
	{
        $input = $request->all();

		$members = $this->membersRepository->store($input);

		Flash::message('members saved successfully.');

		return redirect(route('members.index'));
	}

	/**
	 * Display the specified members.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$members = $this->membersRepository->findmembersById($id);

		if(empty($members))
		{
			Flash::error('members not found');
			return redirect(route('members.index'));
		}

		return view('members.show')->with('members', $members);
	}

	/**
	 * Show the form for editing the specified members.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$members = $this->membersRepository->findmembersById($id);

		if(empty($members))
		{
			Flash::error('members not found');
			return redirect(route('members.index'));
		}

		return view('members.edit')->with('members', $members);
	}

	/**
	 * Update the specified members in storage.
	 *
	 * @param  int    $id
	 * @param CreatemembersRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreatemembersRequest $request)
	{
		$members = $this->membersRepository->findmembersById($id);

		if(empty($members))
		{
			Flash::error('members not found');
			return redirect(route('members.index'));
		}

		$members = $this->membersRepository->update($members, $request->all());

		Flash::message('members updated successfully.');

		return redirect(route('members.index'));
	}

	/**
	 * Remove the specified members from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$members = $this->membersRepository->findmembersById($id);

		if(empty($members))
		{
			Flash::error('members not found');
			return redirect(route('members.index'));
		}

		$members->delete();

		Flash::message('members deleted successfully.');

		return redirect(route('members.index'));
	}

}
