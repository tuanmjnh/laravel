<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Information
 */
class Information extends Model
{
    protected $table = 'information';

    public $timestamps = false;

    protected $fillable = [
        'lang_code',
        'app_key',
        'sub_key',
        'value',
        'sub_value',
        'images',
        'icon',
        'orders',
        'description',
        'flag',
        'extra',
        'application'
    ];

    protected $guarded = [];

        
}