<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateSignature
{
    public function handle(Request $request, Closure $next, array $relative = null): Response
    {
        if ($request->hasValidSignature($relative !== [null])) {
            return $next($request);
        }

        return $request->expectsJson()
            ? abort(403, 'Invalid signature.')
            : redirect()->away(config('app.url'));
    }
}
