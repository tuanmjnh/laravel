<?php namespace Modules\Backend\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminAuthController extends AdminController
{
    protected $guard = 'admin';
    protected $username = 'username';
    protected $redirectTo = '/admin';

    //use ThrottlesLogins, AuthenticatesUsers, RegistersUsers, ResetsPasswords, SendsPasswordResetEmails;//AuthenticatesAndRegistersUsers,

    function __construct()
    {
        parent::__construct();
        $this->middleware('guest', ['except' => 'logout']);
        $this->set_module('login');
        view()->share('lang', $this->set_lang('login', $this->get_current_lang_code()));
    }

    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }

    public function index(\Illuminate\Http\Request $request)
    {
        //return dd([Auth::guard('admin')->check(), Auth::guard('web')->check()]);
        session()->flash('return_url', urlencode($request->query('return') ? $request->query('return') : 'admin'));
        //return dd(session('return_url'));
        if (Auth::guard('admin')->check())
            return redirect('admin');
        return view($this->view_index())
            ->with('route_form', 'auth.login');
    }

    public function login(\Illuminate\Http\Request $request)
    {
        //return dd($request->all());
        $input = $request->all();
        validator($input, $this->validate_rules())->validate();
        $url = session('return_url');
        if (Auth::guard('admin')->attempt(
            ['username' => $input['username'], 'password' => $input['password']],
            isset($input['remember']) ? true : false)) //'active' => 1
            return redirect(urldecode($url));

        \Flash::error($this->lang['error_login']);
        return redirect('admin/auth?return=' . $url);
        //return dd($auth);//Hash::make($input['password'])
    }

    private function validate_rules()
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }

    public function get_user(\Illuminate\Http\Request $request)
    {
        return dd(Auth::guard('admin')->user());
    }

    public function check(\Illuminate\Http\Request $request)
    {
        return dd(Auth::guard('admin')->check());
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/auth');
    }
}