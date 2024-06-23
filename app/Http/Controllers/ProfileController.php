<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('frontend.profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
        ]);
        // Remove "+" from the contact number
        $contact_number = str_replace('+', '', $request->contact_number);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'contact_number' =>  $contact_number,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function showChangePasswordForm()
    {
        return view('frontend.profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile.index')->with('success', 'Password changed successfully');
    }
}
