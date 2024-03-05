<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class LastActiveAt
{

    public function handle(Request $request, Closure $next)
    {

        $user = $request->user();
        if ($user){

            $user->forceFill([

                'last_active_at' =>carbon::now(),

            ])->save();

        }
        return $next($request);
    }
}
