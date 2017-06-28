<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 */
class Setting extends AbstractModel
{
    protected $table = 'setting';

    public $timestamps = false;

    protected $fillable = [
        'app',
        'app_key',
        'sub_key',
        'value',
        'sub_value',
        'description',
        'extra',
        'application'
    ];

    protected $guarded = [];


}