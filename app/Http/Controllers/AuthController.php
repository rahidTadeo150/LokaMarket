<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register-pembeli');
    }

    public function showRegisterPenjualForm()
    {
        return view('auth.register-penjual');
    }

    public function showLoginForm()
    {
        return view('auth.login-page');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.lupa-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('success', 'Link reset password sudah dikirim ke email Anda.');
        }

        return back()->withInput($request->only('email'))->withErrors([
            'email' => __($status),
        ]);
    }

    public function showResetPasswordForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password): void {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => null,
                ])->save();

                Auth::logout();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('cust.login')->with(
                'success',
                'Password berhasil diubah. Silakan login kembali.'
            );
        }

        return back()->withInput($request->only('email'))->withErrors([
            'email' => __($status),
        ]);
    }

    public function loginCustomer(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('cust.landingPage')->with(
                'success',
                'Login berhasil. Selamat datang kembali!'
            );
        }

        return back()->withInput($request->only('email'))->with(
            'error',
            'Email atau password yang Anda masukkan salah.'
        );
    }

    public function registerCustomer(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'no_telp' => 'required|string|max:15|min:10',
            'password' => 'required|min:8',
            'konfirmasi_password' => 'required|same:password',
        ]);
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);
        return redirect()->route('cust.login') ->with(
            'success', 
            'Registrasi berhasil. Silakan login menggunakan akun Anda.'
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('cust.login')
            ->with('success', 'Anda berhasil keluar dari akun anda');
    }
}