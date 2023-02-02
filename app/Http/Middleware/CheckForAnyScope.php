<?php

namespace App\Http\Middleware;

use Laravel\Passport\Http\Middleware\CheckForAnyScope as PassportCheckForAnyScope;

class CheckForAnyScope extends PassportCheckForAnyScope
{

    public function handle($request, $next, ...$scopes)
    {
        if (!$request->user() || !$request->user()->token()) {
            return response(['message' => "Unauthenticated"], 403);
        }

        foreach ($scopes as $scope) {
            if ($request->user()->tokenCan($scope)) {
                return $next($request);
            }
        }

        return response(['message' => "Unauthenticated"], 403);
    }
}
