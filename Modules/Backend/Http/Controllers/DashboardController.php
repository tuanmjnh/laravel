<?php namespace Modules\Backend\Http\Controllers;

use Route;

class DashboardController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->set_middleware();
        $this->set_module('dashboard');
        view()->share('lang', $this->set_lang());
        //URL::setRootControllerNamespace('App\Modules\Backend\Controllers');
    }

    public function index()
    {
        $data = array('title' => 'Dashboard Page');
        return view($this->view_index(), $data);
        //echo "tuanmjnh";
    }

    public function something()
    {
        echo 'tuanmjnh';
    }
}