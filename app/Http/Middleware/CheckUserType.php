<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserType
{
    public function handle($request, Closure $next, $type)
{
    if (auth()->user()->usertype !== $type) {
        return redirect('/unauthorized');
    }
    return $next($request);
}

}

