<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('login',[
            'title' => 'Login Manajemen aplikasi'
        ]);
    }

    public function register(){
        return view('register',[
            'title' => 'Register akun'
        ]);
    }

    public function authenticate(Request $request)
    {
        // dd($request);
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->aktif == 'non-aktif') {
                Auth::logout();

                request()->session()->invalidate();
                request()->session()->regenerateToken();
                return redirect('/auth/login')->with('aktif', 'Maaf, user anda tidak aktif');
            }else{
                if (auth()->user()->role == 3) {
                    return redirect()->intended('/');
                }else{
                    return redirect()->intended('/dashboard/home');
                }
            }
        }
        return back()->with('loginError', 'Login Failed!!!');
    }

    public function store(Request $request)
    {
        // dd($request);
        $vaslidatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'alamat' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $vaslidatedData['password'] = Hash::make($vaslidatedData['password']);
        $vaslidatedData['role'] = '3';
        $vaslidatedData['aktif'] = 'aktif';
        
        User::create($vaslidatedData);
        return redirect('/auth/login')->with('success', 'Registration successfull!! please login');
    }

    public function profiluser(){
        return view('home.profil_user',[
            'title' => 'Profil'
        ]);
    }

    public function profiltoko(){
        return view('dashboard.profil_toko',[
            'title' => 'Profil'
        ]);
    }

    public function update(Request $request, $id){
        // dd($request);
        $rules = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|max:255'
        ]);

        if ($request->password) {
            $rules['password'] = Hash::make($request->password);
        }
        User::where('id', $id)->update($rules);
        
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/auth/login')->with('success', 'Data user berhasil diubah!!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/')->with('success', 'anda berhasil logout');
    }
}
