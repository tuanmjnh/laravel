<?php

namespace App\Libraries\Repositories;


use App\Models\groups;
use Illuminate\Support\Facades\Schema;

class groupsRepository
{

	/**
	 * Returns all groups
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return groups::all();
	}

	public function search($input)
    {
        $query = groups::query();

        $columns = Schema::getColumnListing('groups');
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
	 * Stores groups into database
	 *
	 * @param array $input
	 *
	 * @return groups
	 */
	public function store($input)
	{
		return groups::create($input);
	}

	/**
	 * Find groups by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|groups
	 */
	public function findgroupsById($id)
	{
		return groups::find($id);
	}

	/**
	 * Updates groups into database
	 *
	 * @param groups $groups
	 * @param array $input
	 *
	 * @return groups
	 */
	public function update($groups, $input)
	{
		$groups->fill($input);
		$groups->save();

		return $groups;
	}
}