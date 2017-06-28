<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class Setting
 */
abstract class AbstractModel extends Model
{
    protected $model;

    public function __construct()//Container $app
    {
        //parent::__construct();
        //$this->model = $app->make($this->modelClassName);
        DB::enableQueryLog();
    }

    public static function _db_debug()
    {
        DB::enableQueryLog();
        return dd(DB::getQueryLog());
    }

    public static function _create($input)
    {
        $obj = new static;
        $cols = $obj->fillable;
        foreach ($cols as $col)
            if (isset($input[$col]))
                $obj->$col = $input[$col];
            else
                $obj->$col = null;
        $obj->save();
        return $obj;
    }

    public static function _update($obj_main, $input)
    {
        $obj = new static;
        $cols = $obj->fillable;
        foreach ($cols as $col)
            if (isset($input[$col]))
                $obj_main->$col = $input[$col];
        $obj_main->save();
        return $obj_main;
    }

//    public static function _update($input, $fields_where)
//    {
//        if (!is_array($fields_where))
//            $obj = self::_find_by_id($fields_where);
//        else
//            $obj = self::_find_by_fields($fields_where);
//        if ($obj)
//            foreach ($input as $key => $row)
//                $obj->$key = $row;
//        $obj->save();
//        return $obj;
//    }

    public static function _find_by_id($id, $field = 'id')
    {
        return static::where([$field => $id])->first();
    }

    public static function _find_by_fields($fields)
    {
        return static::where($fields)->first();
    }

    public static function _find($select = null, $fields_where = null, $order = null, $per_page = 0, $distinct = false)
    {
        $query = new static;
        if ($fields_where && is_array($fields_where))
            $query->where($fields_where);
        return $query = self::_get_all($select, $order, $per_page, $distinct);
    }

    public static function _get_all($select = null, $order = null, $distinct = false)
    {
        $query = new static;
        if ($order && is_array($order))
            foreach ($order as $key => $value)
                $query = $query->orderBy($key, $value);

        if ($select) $query = $query->select($select);

        if ($distinct) $query->distinct();

        return $query->get();
    }

    public static function _get_all_paginate($select = null, $order = null, $per_page = 0, $distinct = false)
    {
        $query = self::_get_all($select, $order, $distinct);
        if ($per_page < 1)
            return $query->get();

        return $query->paginate($per_page);
    }

    public static function _get_all_fillable($extra_fillable = null, $select = null, $order = null, $distinct = false)
    {
        $obj = new static;
        $query = self::_get_all($select, $order, $distinct);
        $cols = $obj->fillable;
        $out = array();
        $i = 0;
        foreach ($query as $item) {
            foreach ($cols as $col) {
                $out[$i][$col] = $item->$col;
            }
            if ($extra_fillable && is_array($extra_fillable))
                foreach ($extra_fillable as $col)
                    if (isset($item[$col]))
                        $out[$i][$col] = $item->$col;

            $i++;
        }
        return $out;
    }

    public static function _get_to_fillable($result, $extra_fillable = null)
    {
        $obj = new static;
        $cols = $obj->fillable;
        $out = array();
        $i = 0;
        if (isset($result->$cols[0]))
            foreach ($cols as $col)
                $out[$col] = $result->$col;
        else
            if ($result && is_array($result))
                foreach ($result as $item) {
                    foreach ($cols as $col) {
                        $out[$i][$col] = $item->$col;
                    }
                    if ($extra_fillable && is_array($extra_fillable))
                        foreach ($extra_fillable as $col)
                            if (isset($item[$col]))
                                $out[$i][$col] = $item->$col;

                    $i++;
                }
        return $out;
    }

    public static function _search($input)
    {
        $query = new static;
        $cols = self::_column();
        $attributes = array();
        foreach ($cols as $col) {
            if (isset($input[$col])) {
                $query->where($col, $input[$col]);
                $attributes[$col] = $input[$col];
            } else {
                $attributes[$col] = null;
            }
        };
        return [$query->get(), $attributes];

    }

    public
    static function _column()
    {
        $obj = new static;
        return Schema::getColumnListing($obj->getTable());
    }

    public function _fillable($result = null, $extra_fillable = null)
    {
        $result = is_array($result) ? $result : func_get_args();
        $obj = new static;
        $cols = $obj->fillable;
        $out = array();
        $i = 0;
        if (isset($result->$cols[0]))
            foreach ($cols as $col)
                $out[$i][$col] = $this->extension_method->$col;
        else
            foreach ($result as $item) {
                foreach ($cols as $col) {
                    $out[$i][$col] = $item->$col;
                }
                if ($extra_fillable && is_array($extra_fillable))
                    foreach ($extra_fillable as $col)
                        if (isset($item[$col]))
                            $out[$i][$col] = $item->$col;

                $i++;
            }
        return $out;
    }
}