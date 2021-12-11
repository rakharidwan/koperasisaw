<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {   
        
        $userlogin = User::where('email',$request->email)->first();
        $email = User::where('email',$request->email)->count();
        
        if ($email == 0) {
            $request->authenticate();
        }
        
        if ($userlogin->status_akun == 'terdaftar') {
            $request->authenticate();
            
            $request->session()->regenerate();
            
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        $msg = 'Pendaftaran Anda Ditolak Oleh Admin Pastikan Data Yang Anda Kirimkan Benar Dan Tidak Ada Kesalahan Untuk Info Lebih Lanjut Tekan Selengkapnya';
        if ($userlogin->status_akun == 'ditolak') {
            return redirect('/')->with(['gagal' => $msg]);
        }
        
        return redirect('/')->with(['gagal' => 'Akun Anda Belum Di Verifikasi Mohon Untuk Menunggu Verifikasi Admin']);

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
