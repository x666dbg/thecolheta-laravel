<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // ✅ JANGAN LUPA INI
use App\Models\User;
use App\Models\Customer; // ✅ JANGAN LUPA INI

class AuthController extends Controller
{
    /**
     * 🔹 REGISTER
     */
    public function register(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|string', 
            'birth_date' => 'nullable|date',
        ]);

        DB::beginTransaction(); // Pake Transaction biar aman
        try {
            // Fix format Gender biar huruf depan besar (Laki-laki)
            $genderFixed = isset($validated['gender']) ? ucfirst($validated['gender']) : null;

            // 2. Buat Akun Login (Tabel Users)
            // ✅ Masukkan gender, phone, birth_date DI SINI (sesuai migration users lu)
            $user = User::create([
                'name'       => $validated['name'],
                'email'      => $validated['email'],
                'password'   => Hash::make($validated['password']),
                'phone'      => $validated['phone'] ?? null,
                'gender'     => $genderFixed,      
                'birth_date' => $validated['birth_date'] ?? null,
                'role'       => 'customer',
            ]);

            // 3. Buat Data Profil (Tabel Customers)
            // ❌ JANGAN masukin gender/birth_date di sini kalau di tabel customers ga ada kolomnya
            Customer::create([
                'user_id'    => $user->id,
                'name'       => $user->name,
                'email'      => $user->email,
                'phone'      => $user->phone, 
            ]);

            // 4. Generate Token (Sanctum)
            $token = $user->createToken('auth_token')->plainTextToken;

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'user'    => $user,
                'token'   => $token,
                'token_type' => 'Bearer'
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Registration Failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * 🔹 LOGIN
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        // Cek User & Password Manual
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password salah',
            ], 401);
        }

        // 🔥 GENERATE TOKEN SANCTUM
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'user'    => $user,
            'token'   => $token,
            'token_type' => 'Bearer',
            'redirect' => $user->role === 'admin' ? '/admin/dashboard' : '/profile',
        ]);
    }

    /**
     * 🔹 LOGOUT
     */
    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully',
        ]);
    }

    /**
     * 🔹 GET USER
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * 🔹 UPDATE PROFILE
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        DB::beginTransaction();
        try {
            // 1. Update User Table
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            // 2. Update Customer Table (jika ada)
            Customer::where('user_id', $user->id)->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'user' => $user,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 🔹 CHANGE PASSWORD
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = $request->user();

        // 1. Cek Password Lama
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password saat ini salah.',
            ], 400);
        }

        // 2. Update Password Baru
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully',
        ]);
    }
}