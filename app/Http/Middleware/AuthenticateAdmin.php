<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateAdmin extends Middleware
{
    /**
     * Get the path the admin should be redirected to
     * when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            return route('admin.login');
        }
        return null;
    }
}
