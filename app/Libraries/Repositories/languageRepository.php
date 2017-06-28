<?php

namespace App\Libraries\Repositories;


use App\Models\language;
use Illuminate\Support\Facades\Schema;

class languageRepository
{

	/**
	 * Returns all languages
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return language::all();
	}

	public function search($input)
    {
        $query = language::query();

        $columns = Schema::getColumnListing('languages');
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
	 * Stores language into database
	 *
	 * @param array $input
	 *
	 * @return language
	 */
	public function store($input)
	{
		return language::create($input);
	}

	/**
	 * Find language by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|language
	 */
	public function findlanguageById($id)
	{
		return language::find($id);
	}

	/**
	 * Updates language into database
	 *
	 * @param language $language
	 * @param array $input
	 *
	 * @return language
	 */
	public function update($language, $input)
	{
		$language->fill($input);
		$language->save();

		return $language;
	}
}