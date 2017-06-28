<?php

namespace App\Libraries\Repositories;


use App\Models\items_sub;
use Illuminate\Support\Facades\Schema;

class items_subRepository
{

	/**
	 * Returns all items_subs
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return items_sub::all();
	}

	public function search($input)
    {
        $query = items_sub::query();

        $columns = Schema::getColumnListing('items_subs');
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
	 * Stores items_sub into database
	 *
	 * @param array $input
	 *
	 * @return items_sub
	 */
	public function store($input)
	{
		return items_sub::create($input);
	}

	/**
	 * Find items_sub by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|items_sub
	 */
	public function finditems_subById($id)
	{
		return items_sub::find($id);
	}

	/**
	 * Updates items_sub into database
	 *
	 * @param items_sub $itemsSub
	 * @param array $input
	 *
	 * @return items_sub
	 */
	public function update($itemsSub, $input)
	{
		$itemsSub->fill($input);
		$itemsSub->save();

		return $itemsSub;
	}
}