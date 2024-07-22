<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class FirebaseAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $firebaseAuth = Firebase::auth();
            $idToken = $request->session()->get('firebase_id_token');

            if (!$idToken) {
                return redirect()->route('login')->withErrors(['error' => 'Unauthenticated']);
            }

            try {
                $firebaseAuth->verifyIdToken($idToken);
            } catch (FailedToVerifyToken $e) {
                return redirect()->route('login')->withErrors(['error' => 'The token is invalid: ' . $e->getMessage()]);
            }

            return $next($request);
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['error' => $e->getMessage()]);
        }
    }
}
