<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Lang
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
        //we need to get lang from session so we need use
        $lang = $request->session()->get('lang');
   
             //short way to cheick ?? mean if not = so make default en
             $lang = $lang ?? "en";

            App::setLocale($lang);

              /*   //and cheick if user not chosse lang we make default lang en
            if ($lang == null){
                $lang = "en";
            }*/

        return $next($request);
    }
}
