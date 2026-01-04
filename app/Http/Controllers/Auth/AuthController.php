<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * (1) REGISTER USER BARU
     * Endpoint: POST /api/auth/register
     * Status: 201 bila berjaya, 422 bila validation fail (auto oleh Laravel)
     */
    public function register(Request $request)
    {
        // Validasi input - kalau gagal, Laravel auto return 422
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Create user baru dalam DB
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            // Password wajib hash untuk security
            'password' => Hash::make($validated['password']),
        ]);

        // Return JSON + 201 Created
        return response()->json([
            'message' => 'Pendaftaran berjaya',
            'data' => $user,
        ], 201);
    }

    /**
     * (2) LOGIN USER
     * Endpoint: POST /api/auth/login
     * Status: 200 bila berjaya, 401 bila credentials salah, 422 bila validation fail
     */
    public function login(Request $request)
    {
        // Validasi input login
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Cari user ikut email
        $user = User::where('email', $validated['email'])->first();

        // Check credentials
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            // Salah email/password -> 401
            return response()->json([
                'message' => 'Email atau password tidak sah',
            ], 401);
        }

        // Generate token Sanctum (personal access token)
        $token = $user->createToken('api-token')->plainTextToken;

        // Return token untuk digunakan sebagai Bearer token
        return response()->json([
            'message' => 'Login berjaya',
            'token' => $token,
        ], 200);
    }

    /**
     * (3) USER PROFILE (ME)
     * Endpoint: GET /api/auth/me
     * Perlu auth:sanctum
     * Status: 200 bila berjaya, 401 kalau tiada/invalid token
     */
    public function me(Request $request)
    {
        // Dapatkan user daripada token
        return response()->json([
            'data' => $request->user(),
        ], 200);
    }

    /**
     * (4) LOGOUT
     * Endpoint: POST /api/auth/logout
     * Perlu auth:sanctum
     * Status: 200 bila berjaya, 401 kalau tiada/invalid token
     */
    public function logout(Request $request)
    {
        // Delete token semasa (logout untuk token current)
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berjaya',
        ], 200);
    }
}
