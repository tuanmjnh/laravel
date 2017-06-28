<?php namespace APP\Libraries;

class Auth_User
{
    public static function get_user($guard = 'admin')
    {
        return \Illuminate\Support\Facades\Auth::guard($guard)->user();
    }

    public static function get_username($guard = 'admin')
    {
        return self::get_user($guard)->username;
    }

    public static function get_userid($guard = 'admin')
    {
        return self::get_user($guard)->id;
    }

    public static function get_roles($guard = 'admin')
    {
        return self::get_user($guard)->roles;
    }

    public static function get_salt($guard = 'admin')
    {
        return self::get_user($guard)->salt;
    }

    public static function get_property_name($guard = 'admin')
    {
        return self::get_user($guard)->property_name;
    }

    public static function get_email($guard = 'admin')
    {
        return self::get_user($guard)->email;
    }

    public static function get_phone($guard = 'admin')
    {
        return self::get_user($guard)->phone;
    }

    public static function get_images($guard = 'admin')
    {
        return self::get_user($guard)->images;
    }

    public static function get_remember_token($guard = 'admin')
    {
        return self::get_user($guard)->remember_token;
    }

    public static function get_created_at($guard = 'admin')
    {
        return self::get_user($guard)->created_at;
    }

    public static function get_updated_at($guard = 'admin')
    {
        return self::get_user($guard)->updated_at;
    }

    public static function get_last_inf($guard = 'admin')
    {
        return self::get_user($guard)->last_inf;
    }

    public static function get_last_login($guard = 'admin')
    {
        return self::get_user($guard)->last_login;
    }

    public static function get_last_change_pass($guard = 'admin')
    {
        return self::get_user($guard)->last_change_pass;
    }

    public static function get_login_time($guard = 'admin')
    {
        return self::get_user($guard)->login_time;
    }

    public static function get_locked_by($guard = 'admin')
    {
        return self::get_user($guard)->locked_by;
    }

    public static function get_locked_at($guard = 'admin')
    {
        return self::get_user($guard)->locked_at;
    }

    public static function get_flag_status($guard = 'admin')
    {
        return self::get_user($guard)->flag_lock;
    }
}