<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsKols
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->type === 'kols') {
            return $next($request);
        }

        return redirect()->to('/');
    }
}
