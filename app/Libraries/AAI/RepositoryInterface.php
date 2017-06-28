<?php namespace App\Libraries\AAI;

interface  RepositoryInterface{


    public function make(array $with = array());

    public function all($columns = ['*']);

    public function find($id, $columns = array('*'));

    public function find_by_id($id, $columns = array('*'));

    public function create(array $attributes);

    public function update($input);

    public function destroy($ids);

    public function query($method, $parameters = null);
}