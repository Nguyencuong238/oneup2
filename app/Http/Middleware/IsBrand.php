<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsBrand
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->type === 'brand') {
            return $next($request);
        }

        return redirect()->to('/');
    }
}
