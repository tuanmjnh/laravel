<?php

namespace App\Libraries\Repositories;


use App\Models\groups_items;
use Illuminate\Support\Facades\Schema;

class groups_itemsRepository
{

	/**
	 * Returns all groups_items
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return groups_items::all();
	}

	public function search($input)
    {
        $query = groups_items::query();

        $columns = Schema::getColumnListing('groups_items');
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
	 * Stores groups_items into database
	 *
	 * @param array $input
	 *
	 * @return groups_items
	 */
	public function store($input)
	{
		return groups_items::create($input);
	}

	/**
	 * Find groups_items by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|groups_items
	 */
	public function findgroups_itemsById($id)
	{
		return groups_items::find($id);
	}

	/**
	 * Updates groups_items into database
	 *
	 * @param groups_items $groupsItems
	 * @param array $input
	 *
	 * @return groups_items
	 */
	public function update($groupsItems, $input)
	{
		$groupsItems->fill($input);
		$groupsItems->save();

		return $groupsItems;
	}
}