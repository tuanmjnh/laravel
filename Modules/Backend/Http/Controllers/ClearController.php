<?php namespace Modules\Backend\Http\Controllers;

use Artisan;
use Cache;
use Route;
use Session;

class ClearController extends \Illuminate\Routing\Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'logout']);
    }

    public function index()
    {
        $cache = Artisan::call('cache:clear');
        $view = Artisan::call('view:clear');
        $session = Session::flush();
        Cache::flush();
        $this->unCacheView('*');
        return 'Cleared!';
    }

    public function unCacheView($template)
    {
        $cachedViewsDirectory = app('path.storage') . '/views/';
        if ($template == '*') {
            $files = glob($cachedViewsDirectory . '*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    @unlink($file);
                }
            }
        } else {
            $cacheKey = MD5(app('view.finder')->find($template));
            @unlink($cachedViewsDirectory . $cacheKey);
        }
    }
}