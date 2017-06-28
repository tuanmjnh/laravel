<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Member
 */
class Member extends Model
{
    protected $table = 'members';

    public $timestamps = true;

    protected $fillable = [
        'user_name',
        'password',
        'salt',
        'property_name',
        'email',
        'phone',
        'person_id',
        'address',
        'description',
        'images',
        'remember_token',
        'last_inf',
        'last_login',
        'last_change_pass',
        'login_time',
        'locked_by',
        'locked_at',
        'flag_lock',
        'flag',
        'extra',
        'application'
    ];

    protected $guarded = [];

    protected $hidden = ['password', 'remember_token'];
}