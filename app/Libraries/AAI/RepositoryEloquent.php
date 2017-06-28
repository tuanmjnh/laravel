<?php namespace App\Libraries\AAI;

use App\Models\setting;
use Illuminate\Support\Facades\Schema;

abstract class EloquentRepository
{
	/**
	 * Returns all
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		//return setting::all();
        return $this->model->all();
	}

	public function make(array $with = array()){
		return $this->model->with($with);
	}

	public function getById($id, array $with = array()){
        return $this->make($with)->find($id);
	}

	public function getFirstBy($key, $value, array $with = array()){
        return $this->make($with)->where($key, '=', $value)->first();
	}

	public function getManyBy($key, $value, array $with = array()){
        return $this->make($with)->where($key, '=', $value)->get();
	}



	public function search($input)
	{
		$query = setting::query();

		$columns = Schema::getColumnListing('settings');
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
	 * Stores setting into database
	 *
	 * @param array $input
	 *
	 * @return setting
	 */
	public function store($input)
	{
		return setting::create($input);
	}

	/**
	 * Find setting by given id
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Support\Collection|null|static|setting
	 */
	public function findsettingById($id)
	{
		return setting::find($id);
	}

	/**
	 * Updates setting into database
	 *
	 * @param setting $setting
	 * @param array $input
	 *
	 * @return setting
	 */
	public function update($setting, $input)
	{
		$setting->fill($input);
		$setting->save();

		return $setting;
	}
}