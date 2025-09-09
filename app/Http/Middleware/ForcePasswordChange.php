<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip for guest users
        if (!auth()->check()) {
            return $next($request);
        }

        $user = auth()->user();

        // Check if user still has the default password
        if (Hash::check('ChangeMe123!', $user->password)) {
            // Allow access to settings/password page and logout
            if ($request->routeIs('settings.password') || $request->routeIs('logout')) {
                return $next($request);
            }

            // Redirect to password change with a message
            session()->flash('warning', 'You must change your default password before accessing the application.');
            return redirect()->route('settings.password');
        }

        return $next($request);
    }
}
