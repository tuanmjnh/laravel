<?php

namespace App\Libraries\Repositories;


use App\Models\items;
use Illuminate\Support\Facades\Schema;

class itemsRepository
{

	/**
	 * Returns all items
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return items::all();
	}

	public function search($input)
    {
        $query = items::query();

        $columns = Schema::getColumnListing('items');
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
	 * Stores items into database
	 *
	 * @param array $input
	 *
	 * @return items
	 */
	public function store($input)
	{
		return items::create($input);
	}

	/**
	 * Find items by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|items
	 */
	public function finditemsById($id)
	{
		return items::find($id);
	}

	/**
	 * Updates items into database
	 *
	 * @param items $items
	 * @param array $input
	 *
	 * @return items
	 */
	public function update($items, $input)
	{
		$items->fill($input);
		$items->save();

		return $items;
	}
}