<?php

namespace App\Libraries\Repositories;


use App\Models\users;
use Illuminate\Support\Facades\Schema;

class usersRepository
{

	/**
	 * Returns all users
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return users::all();
	}

	public function search($input)
    {
        $query = users::query();

        $columns = Schema::getColumnListing('users');
        $attributes = array();

        foreach($columns as $attribute){
            if(isset($input[$attribute]))
            {
                $query->where($attribute, $input[$attribute]);
                $attributes[$attribute] =  $input[$attribute];
            }else{
                $attributes[$attribute] =  null;
            }
        };

        return [$query->get(), $attributes];

    }

	/**
	 * Stores users into database
	 *
	 * @param array $input
	 *
	 * @return users
	 */
	public function store($input)
	{
		return users::create($input);
	}

	/**
	 * Find users by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|users
	 */
	public function findusersById($id)
	{
		return users::find($id);
	}

	/**
	 * Updates users into database
	 *
	 * @param users $users
	 * @param array $input
	 *
	 * @return users
	 */
	public function update($users, $input)
	{
		$users->fill($input);
		$users->save();

		return $users;
	}
}