<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.pages.profiles.index');
    }

    public function update(Request $request, User $profile)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,' . $profile->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $profile->name  = $request->input('name');
        $profile->email = $request->input('email');

        if ($request->filled('password')) {
            $profile->password = bcrypt($request->input('password'));
        }

        $profile->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.'
            ]);
        }
    }
}
