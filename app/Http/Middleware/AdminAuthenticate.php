<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
class AdminAuthenticate
{




    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
      //return response($request, 401);
          if ($request->header("token"))
        {
            $token=$request->header("token");
            $user=User::Where("token", $token)->first();

            if ($user && $user->is_staff){
              $request->user=$user;
              return $next($request);
            }
          }
          return response('Unauthorized You must be admin to do this action.', 401);

    }
}
