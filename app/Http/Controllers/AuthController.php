<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login() 
    {
        return view('login');
    }
    
    public function register()
    {
        return view('register');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        //cek apakah login benar
        
        if(Auth::attempt($credentials)) {
            //cek apakah user status = aktif
            if(Auth::user()->status != "active") {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                Session::flash('status', 'danger');
                Session::flash('message', 'Your account is not active yet, please contact admin!');
                return redirect('/login');
            }

            $request->session()->regenerate();
            if(Auth::user()->role_id == 1) {
                return redirect('dashboard');
            }
            
            if(Auth::user()->role_id == 2) {
                return redirect('dashboard');
            }

            if(Auth::user()->role_id == 3) {
                return redirect('/books/buku');
            }
        }

        Session::flash('status', 'danger');
        Session::flash('message', 'Login Invalid');
        return redirect('/login');
    }

    public function registerProses(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|unique:users|max:255',
            'name' => 'required|max:255',
            'password' => 'required|max:255',
            'email' => 'required|max:100',
            'address' => 'required',
        ]);
        
        
        $data = [
            'username' => $request->username,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'address' => $request->address
        ];

        User::create($data);

        Session::flash('status', 'success');
        Session::flash('message', 'Regist success. please login');
        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
