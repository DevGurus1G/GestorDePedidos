<?php

// En tu middleware personalizado CanOneOf.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class CanOneOf
{
    public function handle($request, Closure $next, ...$abilities)
    {
        foreach ($abilities as $ability) {
            if (Gate::allows($ability)) {
                return $next($request);
            }
        }

        abort(403, 'No tienes permiso para acceder a esta ruta.');
    }
}
