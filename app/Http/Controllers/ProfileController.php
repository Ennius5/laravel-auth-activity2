<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProfileController extends Controller
{
//     public function show(){
//         $user = User::find(Session::get('user_id'));
//         return view('profile.show', compact('user'));
//     } UNUSED, moved to PageViewController

public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'current_password' => 'nullable|required_with:password',
        'password' => 'nullable|min:6|confirmed'
    ]);

    // Verify current password if changing password
    if ($request->filled('password')) {
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }
    }

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return back()->with('success', 'Profile updated successfully');
}

    public function profile()
{
    $user = Auth::user();

    $totalTasks = $user->tasks()->count();
    $completedTasks = $user->tasks()->where('completed', true)->count();
    $pendingTasks = $user->tasks()->where('completed', false)->count();
    $overdueTasks = $user->tasks()
        ->where('completed', false)
        ->where('due_date', '<', now())
        ->count();

    $recentTasks = $user->tasks()
        ->latest()
        ->take(5)
        ->get();

    return view('profile.show', compact(
        'totalTasks',
        'completedTasks',
        'pendingTasks',
        'overdueTasks',
        'recentTasks'
    ));
}




    //
}
