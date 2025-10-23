<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsBranch
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->type === 'branch') {
            return $next($request);
        }

        return redirect()->to('/');
    }
}
