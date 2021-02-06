<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanEnterEaxam
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

        // هنا هنمنع المستخدم انه يلعب ف الرابط ويرجع للصفحه الاولى تانى  دى موجوده ف لارافيل
        $examId = $request->route()->parameter('id');
        $user = Auth::user();
        $pivotRow = $user->exams()->where('exam_id' , $examId)->first();
        if ($pivotRow!== null and $pivotRow->pivot->status == 'closed' ) {
            return redirect ( url("/") );
        }

        return $next($request);
    }
}
