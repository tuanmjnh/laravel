<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class GroupsItem
 */
class GroupsItem extends Model
{
    protected $table = 'groups_items';

    public $timestamps = true;

    protected $fillable = [
        'gid',
        'iid',
        'type',
        'description',
        'end_at',
        'orders',
        'application'
    ];

    protected $guarded = [];

        
}