<?php

namespace App\Libraries\Repositories;


use App\Models\information;
use Illuminate\Support\Facades\Schema;

class informationRepository
{

	/**
	 * Returns all information
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return information::all();
	}

	public function search($input)
    {
        $query = information::query();

        $columns = Schema::getColumnListing('information');
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
	 * Stores information into database
	 *
	 * @param array $input
	 *
	 * @return information
	 */
	public function store($input)
	{
		return information::create($input);
	}

	/**
	 * Find information by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|information
	 */
	public function findinformationById($id)
	{
		return information::find($id);
	}

	/**
	 * Updates information into database
	 *
	 * @param information $information
	 * @param array $input
	 *
	 * @return information
	 */
	public function update($information, $input)
	{
		$information->fill($input);
		$information->save();

		return $information;
	}
}