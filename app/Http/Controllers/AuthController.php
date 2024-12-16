<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function post(Request $request)
    {
        // dd(request()->all());
        $cre = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($cre)) {
            session()->regenerate();
            return redirect()->intended('/dashboard');
        } else {
            return redirect()->back()->with('warning', 'Username Atau Password Anda Salah');
        }
    }


    public function register()
    {
        $role = Role::whereNotIn('kode_role', ['SAD'])->get();
        return view('auth.register', [
            'roles' => $role
        ]);

        
    }

    public function store(Request $request)
    {
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        $user->roles()->attach($request->role_id);

        return redirect()->route('auth.login')->with('success', 'akun anda berhasil diregistrasi, coba login!');

    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
