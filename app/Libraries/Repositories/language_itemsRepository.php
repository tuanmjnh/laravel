<?php

namespace App\Libraries\Repositories;


use App\Models\language_items;
use Illuminate\Support\Facades\Schema;

class language_itemsRepository
{

	/**
	 * Returns all language_items
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return language_items::all();
	}

	public function search($input)
    {
        $query = language_items::query();

        $columns = Schema::getColumnListing('language_items');
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
	 * Stores language_items into database
	 *
	 * @param array $input
	 *
	 * @return language_items
	 */
	public function store($input)
	{
		return language_items::create($input);
	}

	/**
	 * Find language_items by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|language_items
	 */
	public function findlanguage_itemsById($id)
	{
		return language_items::find($id);
	}

	/**
	 * Updates language_items into database
	 *
	 * @param language_items $languageItems
	 * @param array $input
	 *
	 * @return language_items
	 */
	public function update($languageItems, $input)
	{
		$languageItems->fill($input);
		$languageItems->save();

		return $languageItems;
	}
}