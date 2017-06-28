<?php namespace App\Libraries\AAI;

use Illuminate\Container\Container;
use Illuminate\Contracts\Validation\Validator;

abstract class RepositoryAbstract implements RepositoryInterface
{

    protected $model;

    public function __construct(Container $app)
    {
        $this->model = $app->make($this->modelClassName);
    }

    public function table_name()
    {
        return (new $this->model)->getTable();
    }

    public function make(array $with = array())
    {
        return $this->model->with($with);
    }

    public function make_fnc(array $with = array())
    {
        return $this->model->belongs_to($this->table_name())->select($with);
//        return $this->model->with([$this->table_name()=>function($query){
//            $query->select($with);
//        }]);
    }

    public function all($columns=null)
    {
        if ($columns==null)
            return $this->model->all();
        else
            return $this->model->all($columns);
        //return call_user_func_array("{$this->model}::all", array($columns));
    }

    public function find($id, $columns = array('*'))
    {
        return $this->model->find(array($id, $columns));
        //return call_user_func_array("{$this->model}::find", array($id, $columns));
    }

    public function find_by_id($id, $columns = array('*'))
    {
        return $this->make->find(array($id, $columns));
        //return call_user_func_array("{$this->model}::find", array($id, $columns));
    }

    public function create(array $attributes)
    {
        $this->model->create($attributes);
        //$this->model->save((array)$attributes);
        //return call_user_func_array("{$this->model}::create", array($attributes));
    }

    public function update($input)
    {
        $this->model->fill($input);
        $this->model->save();
        return $this->model->get();
    }

    public function destroy($ids)
    {
        //return call_user_func_array("{$this->model}::destroy", array($ids));
    }

    public function query($method, $parameters = null)
    {
//        $callable = $this->model . '::' . $method;
//        if (func_num_args() > 1)
//            return call_user_func_array($callable, array_slice(func_get_args(), 1));
//        return call_user_func($callable);
    }

    protected function formatValidationErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }
}