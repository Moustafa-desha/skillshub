<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $adminRole = Role::where('name' , 'admin')->first();
        // if (Auth::user()->role_id !== $adminRole) {
        //     return redirect( url('/') );
        // }
        if (Auth::user()->role->name == 'admin') {
            return $next($request);
        }
        return redirect( url('/') );
    }
}
