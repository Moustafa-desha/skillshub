<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsStudent
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
        
       // $studentRole = Role::where('name', 'student')->first();
        // if (Auth::user()->role_id !== 3) {
        //     return redirect( url('/') );
        // }
        if (Auth::user()->role->name == 'student') {
            return $next($request);
        }
        return redirect( url('/') );
    }
}
