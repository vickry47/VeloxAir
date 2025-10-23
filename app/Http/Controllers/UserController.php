<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        return view('users.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Update password jika diisi
        if ($request->new_password) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah.']);
            }
            
            $user->update(['password' => Hash::make($request->new_password)]);
        }

        return back()->with('success', 'Profile berhasil diupdate.');
    }

    public function bookingHistory()
    {
        $bookings = auth()->user()->bookings()
            ->with(['flight.plane.airline', 'payment'])
            ->latest()
            ->get();
            
        return view('users.booking-history', compact('bookings'));
    }
}