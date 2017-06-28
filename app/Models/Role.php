<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 */
class Role extends Model
{
    protected $table = 'roles';

    public $timestamps = true;

    protected $fillable = [
        'app_key',
        'value',
        'description',
        'images',
        'icon',
        'created_by',
        'updated_by',
        'orders',
        'extra',
        'application'
    ];

    protected $guarded = [];

        
}