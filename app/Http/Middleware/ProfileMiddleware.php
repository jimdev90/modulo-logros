<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$profiles)
    {
//        foreach($profiles as $profile) {
//            if ($request->user()->unidad_usuario->profile !== $profile) {
//                return redirect()->route('dashboard');
//            }else {
//                return $next($request);
//            }
//        }

        if (in_array($request->user()->unidad_usuario->profile, $profiles)) {
            return $next($request);
        }else {
            return redirect()->route('dashboard');
        }

    }
}
