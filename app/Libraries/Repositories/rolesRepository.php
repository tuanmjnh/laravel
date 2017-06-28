<?php

namespace App\Libraries\Repositories;


use App\Models\roles;
use Illuminate\Support\Facades\Schema;

class rolesRepository
{

	/**
	 * Returns all roles
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return roles::all();
	}

	public function search($input)
    {
        $query = roles::query();

        $columns = Schema::getColumnListing('roles');
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
	 * Stores roles into database
	 *
	 * @param array $input
	 *
	 * @return roles
	 */
	public function store($input)
	{
		return roles::create($input);
	}

	/**
	 * Find roles by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|roles
	 */
	public function findrolesById($id)
	{
		return roles::find($id);
	}

	/**
	 * Updates roles into database
	 *
	 * @param roles $roles
	 * @param array $input
	 *
	 * @return roles
	 */
	public function update($roles, $input)
	{
		$roles->fill($input);
		$roles->save();

		return $roles;
	}
}