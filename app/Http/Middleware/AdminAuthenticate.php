<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        //return dd([Auth::guard('admin')->check(), Auth::guard('web')->check()]);//$request->route()
        //return dd(Auth::guard($guard)->guest());
//        if (Auth::guard($guard)->guest()) {
//            if ($request->ajax() || $request->wantsJson()) {
//                return response('Unauthorized.', 401);
//            } else {
//                return redirect()->guest('admin/auth');
//            }
//        }
        if (!Auth::guard($guard)->check())
            return redirect('/admin/auth?return=' . urlencode($request->route()->uri()));
        return $next($request);
    }
}
