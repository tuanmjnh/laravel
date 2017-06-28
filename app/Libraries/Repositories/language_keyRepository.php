<?php

namespace App\Libraries\Repositories;


use App\Models\language_key;
use Illuminate\Support\Facades\Schema;

class language_keyRepository
{

	/**
	 * Returns all language_keys
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return language_key::all();
	}

	public function search($input)
    {
        $query = language_key::query();

        $columns = Schema::getColumnListing('language_keys');
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
	 * Stores language_key into database
	 *
	 * @param array $input
	 *
	 * @return language_key
	 */
	public function store($input)
	{
		return language_key::create($input);
	}

	/**
	 * Find language_key by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|language_key
	 */
	public function findlanguage_keyById($id)
	{
		return language_key::find($id);
	}

	/**
	 * Updates language_key into database
	 *
	 * @param language_key $languageKey
	 * @param array $input
	 *
	 * @return language_key
	 */
	public function update($languageKey, $input)
	{
		$languageKey->fill($input);
		$languageKey->save();

		return $languageKey;
	}
}