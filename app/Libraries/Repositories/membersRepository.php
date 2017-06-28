<?php

namespace App\Libraries\Repositories;


use App\Models\members;
use Illuminate\Support\Facades\Schema;

class membersRepository
{

	/**
	 * Returns all members
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return members::all();
	}

	public function search($input)
    {
        $query = members::query();

        $columns = Schema::getColumnListing('members');
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
	 * Stores members into database
	 *
	 * @param array $input
	 *
	 * @return members
	 */
	public function store($input)
	{
		return members::create($input);
	}

	/**
	 * Find members by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|members
	 */
	public function findmembersById($id)
	{
		return members::find($id);
	}

	/**
	 * Updates members into database
	 *
	 * @param members $members
	 * @param array $input
	 *
	 * @return members
	 */
	public function update($members, $input)
	{
		$members->fill($input);
		$members->save();

		return $members;
	}
}