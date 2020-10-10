<?php

namespace App\Http\Middleware;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Closure;

class verifyUserAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $header = $request->header('Authorization', '');
        if ($header == '') {
            return response()->restaurantApi(null,null, 'User missing access token', array(['Missing User Access Token']));
        }
        if (Str::startsWith($header, 'Bearer ')) {
            $header = Str::substr($header, 7);
            $user   = User::where('access_token', '=', $header)->get()->first();
            if ($user) {
                return $next($request);
            } else {
                return response()->restaurantApi(null,null, 'Sorry System Authentication Error!!!', array(['you donot have access the specific user details']));
            }
        }
         
       
    }
}
