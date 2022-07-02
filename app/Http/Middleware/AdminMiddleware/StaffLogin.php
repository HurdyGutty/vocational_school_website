<?php

namespace App\Http\Middleware\AdminMiddleware;

use Closure;
use Illuminate\Http\Request;

class StaffLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (empty(getRole())) {
            return redirect()->route('admin.auth.view_login');
        }

        return $next($request);
    }
}
