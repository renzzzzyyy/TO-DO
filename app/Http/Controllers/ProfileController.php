<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = User::find(Session::get('user_id'));
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Session::get('user_id'));

        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $user = User::find(Session::get('user_id'));

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully');
    }

    public function uploadProfilePicture(Request $request)
    {
        $user = User::find(Session::get('user_id'));

        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture) {
                $oldPath = public_path('uploads/profile/' . $user->profile_picture);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $file = $request->file('profile_picture');
            $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            if (!file_exists(public_path('uploads/profile'))) {
                mkdir(public_path('uploads/profile'), 0755, true);
            }
            
            $file->move(public_path('uploads/profile'), $filename);
            
            $user->profile_picture = $filename;
            $user->save();
        }

        return back()->with('success', 'Profile picture updated successfully');
    }

    public function removeProfilePicture()
    {
        $user = User::find(Session::get('user_id'));

        if ($user->profile_picture) {
            $oldPath = public_path('uploads/profile/' . $user->profile_picture);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
            
            $user->profile_picture = null;
            $user->save();
        }

        return back()->with('success', 'Profile picture removed successfully');
    }
}
