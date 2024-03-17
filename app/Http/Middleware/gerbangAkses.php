<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class gerbangAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $posisi = Auth::user()->identitas->posisi;
        if($posisi == "admin" || $posisi == "tu") {
            return $next($request);
        }else {
            return redirect("home")->with('warning', 'Maaf hanya bisa dikelola oleh admin atau TU');
        }
    }
}
