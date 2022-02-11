<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Cache;
use App\Models\User;

class UserActivity
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
        if (Auth::check()) {
            $expireAt = Carbon::now()->addMinutes(5);

            Cache::put('useronline-'.Auth::user()->id,true,$expireAt);

            User::where('id', Auth::user()->id)->update(['lastseen'=>now()]);

        }
        return $next($request);
    }
}
