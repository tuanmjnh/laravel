<?php

namespace App\Libraries\Repositories;


use App\Models\groups_groups;
use Illuminate\Support\Facades\Schema;

class groups_groupsRepository
{

	/**
	 * Returns all groups_groups
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return groups_groups::all();
	}

	public function search($input)
    {
        $query = groups_groups::query();

        $columns = Schema::getColumnListing('groups_groups');
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
	 * Stores groups_groups into database
	 *
	 * @param array $input
	 *
	 * @return groups_groups
	 */
	public function store($input)
	{
		return groups_groups::create($input);
	}

	/**
	 * Find groups_groups by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|groups_groups
	 */
	public function findgroups_groupsById($id)
	{
		return groups_groups::find($id);
	}

	/**
	 * Updates groups_groups into database
	 *
	 * @param groups_groups $groupsGroups
	 * @param array $input
	 *
	 * @return groups_groups
	 */
	public function update($groupsGroups, $input)
	{
		$groupsGroups->fill($input);
		$groupsGroups->save();

		return $groupsGroups;
	}
}