<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FirebaseAuthMiddleware
{
    public function handle(Request $request, Closure $next, $role = null)
    {
        try {
            $firebaseAuth = Firebase::auth();
            $id = $request->session()->get('uid');

            if (!$id) {
                return redirect()->route('login')->withErrors(['error' => 'Unauthenticated']);
            }

            $firebaseUser = $firebaseAuth->getUser($id);
            $userRole = $firebaseUser->customClaims['role'] ?? null;

            if (!$userRole || ($role && $userRole !== $role)) {
                return redirect()->route('login')->withErrors(['error' => 'Unauthorized']);
            }

            return $next($request);
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => $e->getMessage()]);
        }
    }
}
