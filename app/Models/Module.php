<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Module
 */
class Module extends Model
{
    protected $table = 'modules';

    public $timestamps = true;

    protected $fillable = [
        'parent_id',
        'level',
        'parent_sid',
        'title',
        'desc',
        'url',
        'icon',
        'roles',
        'created_by',
        'updated_by',
        'orders',
        'flag',
        'extra',
        'application'
    ];

    protected $guarded = [];

        
}