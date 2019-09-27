<?php

namespace App\Http\Middleware;

use Closure;

class SiteModule
{
    public function handle($request, Closure $next, $module)
    {
        $site_module = \App\SiteModule::where('name', $module)
            ->where('is_enabled', true)
            ->first();
        if($site_module) {
            return $next($request);
        }
        return abort(404);
    }
}