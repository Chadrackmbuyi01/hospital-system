<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symphony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user() || !$this->hasRole($request->user(), $role)){
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }

    private function hasRole($user, string $role): bool
    {
        return $user->role === $role ||
                ($role === 'staff' && in_array($user->role, ['receptionist', 'nurse', 'doctor']));
    }
}