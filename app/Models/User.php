<?php namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 */
class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';

    public $timestamps = true;

    protected $fillable = [
        'roles',
        'username',
        'password',
        'salt',
        'property_name',
        'email',
        'phone',
        'images',
        'remember_token',
        'last_inf',
        'last_login',
        'last_change_pass',
        'login_time',
        'locked_by',
        'locked_at',
        'flag_lock',
        'application'
    ];

    protected $guarded = ['id'];

    protected $hidden = ['password', 'remember_token'];

}