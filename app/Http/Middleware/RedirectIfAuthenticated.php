<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        $adminEmails = [
            'yousha.cse.20230104097@aust.edu',
            'aaheed.cse.20230104092@aust.edu',
            'miraz.cse.20230104092@aust.edu',
            'noman.cse.20230104088@aust.edu',
        ];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (in_array(Auth::guard($guard)->user()->email, $adminEmails)) {
                    return redirect()->route('admin.dashboard');
                }
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
