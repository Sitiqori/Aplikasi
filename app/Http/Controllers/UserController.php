<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('role_id', '!=', 1)->where('status', 'active')->get();
        return view('users.user', compact('user'));

    }



    public function profile()
    {
        $returnedRentLogs = RentLogs::with(['user', 'book'])
            ->where('user_id', Auth::user()->id)
            ->where('status_peminjaman', 'dikembalikan')
            ->get();

        $unreturnedRentLogs = RentLogs::with(['user', 'book'])
            ->where('user_id', Auth::user()->id)
            ->where('status_peminjaman', 'dipinjam')
            ->get();

        return view('users.profile', compact('returnedRentLogs', 'unreturnedRentLogs'));
    }
    public function changeRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'new_role_id' => 'required|in:2,3 ',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->role_id = $request->new_role_id;
        $user->save();

        return redirect()->back()->with('success', 'berhasil di update.' );

    }


    public function registeredUser()
    {
        $registered = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('users.registered', compact('registered'));
    }

    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        $rentlogs = RentLogs::with(['user', 'book'])->where('user_id', $user->id)->get();
        return view('users.user-detail', compact('user', 'rentlogs'));
    }

    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();
        return redirect('/users/user-detail/' . $slug)->with('status', 'User Approved Successfuly');
    }

    public function destroy($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();
        return redirect()->route('users.index')->with('status', 'User Deleted Successfuly');
    }

    public function bannedUser()
    {
        $bannedUser = User::onlyTrashed()->get();
        return view('users.user-banned', compact('bannedUser'));
    }

    public function restore($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();

        return redirect()->route('users.index')->with('status', 'User Restored Successfuly');
    }
}
