<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login',[
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->with('loginError', 'Login Gagal! Username atau password salah');
    }

    public function register()
    {
        return view('auth.register',[
            'title'=>'Register'
        ]);
    }

    public function create_user(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'username' => 'required|unique:users',
            'jenis_kelamin' => 'required',
            'password' => 'required|min:5|max:255',
        ]);

        // return request();

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['jabatan']='Masyarakat';

        User::create($validatedData);

        return redirect()
        ->route('user.index')
        ->with('success', 'Sukses! Data Pengguna Berhasil Disimpan');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
