<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class EnsureAdminEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @return void|Response|RedirectResponse
     */
    public function handle(
        Request $request,
        Closure $next,
        ?string $redirectToRoute = null
    ) {
        if (! $request->user() ||
            ($request->user() instanceof MustVerifyEmail &&
                ! $request->user()->hasVerifiedEmail())) {
            return $request->expectsJson()
                ? abort(
                    403,
                    "Votre adresse email n'est pas vérifiée."
                )
                : Redirect::route(
                    $redirectToRoute ?? 'admin.verification.notice'
                );
        }

        return $next($request);
    }
}
