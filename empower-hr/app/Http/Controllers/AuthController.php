<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Handle login and issue a Sanctum token.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate the incoming request data.
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to find the user by email.
        $user = User::where('email', $request->email)->first();

        // Check if user exists and if the password is correct.
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Create a new token for the user.
        $token = $user->createToken('api-token')->plainTextToken;

        // Return the user details along with the token.
        return response()->json([
            'user'  => $user,
            'token' => $token,
        ]);
    }

    /**
     * Logout the user by revoking the token.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request.
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
