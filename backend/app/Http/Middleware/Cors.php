<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cors
{
    public function handle(Request $request, Closure $next)
    {
        // Les headers CORS sont gérés par Nginx (voir docker/default.conf)
        // On ne fait rien ici pour éviter la duplication des headers
        
        return $next($request);
    }
}
