<?php
// app/Http/Controllers/Api/AuthController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Le credenziali fornite sono errate.'],
            ]);
        }

        $token = $user->createToken('enjoypark-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'preferences' => [
                'language' => 'it',
                'theme' => 'light',
                'notifications' => true,
                'newsletter' => false,
            ],
            'membership' => 'standard',
        ]);

        $token = $user->createToken('enjoypark-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logout effettuato con successo']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'avatar' => 'sometimes|string|max:255',
            'preferences' => 'sometimes|array',
        ]);

        $user->update($request->only(['name', 'avatar', 'preferences']));

        return response()->json($user);
    }

    // Add these new methods:
    public function getAllUsers(Request $request)
    {
        // Only allow admin users
        if (!$request->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $users = User::all();
        return response()->json($users);
    }

    public function updateUserRole(Request $request, User $user)
    {
        // Only allow admin users
        if (!$request->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $request->validate([
            'is_admin' => 'required|boolean',
        ]);
        
        $user->update([
            'is_admin' => $request->is_admin
        ]);
        
        return response()->json($user);
    }

    public function createUser(Request $request)
    {
        // Only allow admin users
        if (!$request->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'is_admin' => 'sometimes|boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin ?? false,
            'preferences' => [
                'language' => 'it',
                'theme' => 'light',
                'notifications' => true,
                'newsletter' => false,
            ],
            'membership' => 'standard',
        ]);

        return response()->json($user, 201);
    }

    public function updateUser(Request $request, User $user)
    {
        // Only allow admin users
        if (!$request->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:6',
            'is_admin' => 'sometimes|boolean',
        ]);

        $updateData = $request->only(['name', 'email', 'is_admin']);
        
        // Only hash password if it's being updated
        if ($request->has('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return response()->json($user);
    }

    public function deleteUser(Request $request, User $user)
    {
        // Only allow admin users
        if (!$request->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        // Prevent admin from deleting themselves
        if ($user->id === $request->user()->id) {
            return response()->json(['message' => 'Cannot delete your own account'], 400);
        }
        
        $user->delete();
        
        return response()->json(['message' => 'User deleted successfully']);
    }
}