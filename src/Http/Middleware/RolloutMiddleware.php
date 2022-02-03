<?php

namespace Jaspaul\LaravelRollout\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Jaspaul\LaravelRollout\Facade\Rollout;

class RolloutMiddleware
{
    public function handle(Request $request, Closure $next, string ...$features)
    {
        foreach ($features as $feature) {

            if (! Rollout::isActive($feature)) {
                throw new AuthorizationException('Unauthenticated.');
            }
        }

        return $next($request);
    }
}
