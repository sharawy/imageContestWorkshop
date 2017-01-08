<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
class TokenAuthenticate
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

          if ($request->header("token"))
        {
            $token=$request->header("token");
            $user=User::Where("token", $token)->first();

            if ($user){

              $request->user=$user;
              return $next($request);
            }
          }
          return response()->json(['msg'=>"Unauthorized"],401);

    }
}
