<?php

// namespace App\Http\Middleware;

// use Closure;
// use Exception;
// use GuzzleHttp\Psr7\Request;
// use Illuminate\Http\Request as HttpRequest;
// use Illuminate\Support\Facades\Request as FacadesRequest;
// use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
// use Tymon\JWTAuth\Facades\JWTAuth;


// class JwtMiddleware
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */
//         public function handle(Request $request, Closure $next)
//         {
//             try {
//                 $user = JWTAuth::parseToken()->authenticate();
//             } catch (\Exception $e) {
//                 if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
//                     return response()->json(['status' => 'Token is Invalid']);
//                 }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
//                     return response()->json(['status' => 'Token is Expired']);
//                 }else{
//                     return response()->json(['status' => 'Authorization Token not found']);
//                 }
//         return $next($request);
//     }
// }
// } 

namespace App\Http\Middleware;

use Closure;
// use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware extends BaseMiddleware
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
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status' => 'Token is Expired']);
            }else{
                return response()->json(['status' => 'Authorization Token not found']);
            }
        }
        return $next($request);
    }
}

