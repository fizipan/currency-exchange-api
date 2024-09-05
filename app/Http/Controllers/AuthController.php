<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\AuthResource;
use App\Http\Resources\Auth\AuthUserResource;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    // User login
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $token = auth()->attempt($credentials);
        try {
            if (!$token) {
                return response()->json([
                    'error' => 'Invalid email or password. Please try again.'
                ], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not create token. Please try again later.'
            ], 500);
        }

        return $this->respondWithToken(auth()->user(), $token);
    }

    // Get authenticated user
    public function me()
    {
        return new AuthUserResource(auth()->user());
    }

    // Refresh the JWT token
    public function refresh()
    {
        $token = auth()->refresh();

        return $this->respondWithToken(auth()->user(), $token);
    }

    // Logout
    public function logout()
    {
        auth()->logout(true);

        return response()->json(['message' => 'Successfully logged out']);
    }

    // Response with token
    public function respondWithToken($user, $token)
    {
        return new AuthResource([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
