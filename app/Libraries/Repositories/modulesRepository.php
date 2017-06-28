<?php

namespace App\Libraries\Repositories;


use App\Models\modules;
use Illuminate\Support\Facades\Schema;

class modulesRepository
{

	/**
	 * Returns all modules
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return modules::all();
	}

	public function search($input)
    {
        $query = modules::query();

        $columns = Schema::getColumnListing('modules');
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
	 * Stores modules into database
	 *
	 * @param array $input
	 *
	 * @return modules
	 */
	public function store($input)
	{
		return modules::create($input);
	}

	/**
	 * Find modules by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|modules
	 */
	public function findmodulesById($id)
	{
		return modules::find($id);
	}

	/**
	 * Updates modules into database
	 *
	 * @param modules $modules
	 * @param array $input
	 *
	 * @return modules
	 */
	public function update($modules, $input)
	{
		$modules->fill($input);
		$modules->save();

		return $modules;
	}
}