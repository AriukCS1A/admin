<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Нэвтрэх мэдээллийг шалгах
        $credentials = $request->only('email', 'password');

        // Нэвтрэлтийг шалгаж, 'remember me' тохиргоог харгалзан шалгах
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // Нэвтэрсний дараа сессийг шинэчлэх
            $request->session()->regenerate();

            // Амжилттай нэвтэрсэн тохиолдолд админ панел руу чиглүүлэх
            return redirect()->intended('/admin');
        }

        // Нэвтрэлт амжилтгүй болвол буцаан чиглүүлэх
        return back()->withErrors([
            'email' => 'Нэвтрэх мэдээлэл буруу байна.',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
