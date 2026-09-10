<?php

namespace App\Http\Controllers;

use App\Models\pending_registration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Mail\VerifyRegistrationMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;

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

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tersebut tidak ditemukan.'
            ]);
        }

        $token = Password::broker()->createToken($user);

        $resetUrl = route('password.reset', [
            'token' => $token,
            'email' => $user->email,
        ]);

        Mail::to($user->email)->send(
            new ResetPasswordMail(
                $user,
                $resetUrl
            )
        );

        return back()->with(
            'success',
            'Link reset password telah dikirim ke email Anda.'
        );
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
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            
            function ($user, $password) {

                $user->update([
                    'password' => Hash::make($password),
                ]);

            }
        );

        if ($status === Password::PASSWORD_RESET) {

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()
                ->route('cust.login')
                ->with(
                    'success',
                    'Password berhasil diubah. Silakan login dengan password baru.'
                );
        }

        return back()->withErrors([
            'email' => 'Link reset password tidak valid atau sudah kedaluwarsa.'
        ]);
    }

    public function loginCustomer(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
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
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'no_telp' => 'required|string|max:15|min:10',
            'password' => 'required|min:8',
            'konfirmasi_password' => 'required|same:password',
        ], [
            'email.unique' => 'Email ini sudah digunakan. Silakan gunakan email lain'
        ]);

        $nama = Str::title(strtolower(trim($request->nama)));

        $noTelp = preg_replace('/\D/', '', $request->no_telp);

        $noTelp = '+62' . $noTelp;

        $token = Str::random(64);

        $pending = pending_registration::updateOrCreate(
            ['email' => $request->email],
            [
                'username' => $request->username,
                'nama' => $nama,
                'no_telp' => $noTelp,
                'password' => Hash::make($request->password),
                'token' => $token,
                'expires_at' => now()->addMinutes(30),
            ]
        );

        session([
            'verification_email' => $pending->email,
        ]);

        $verificationUrl = route('verification.verify', [
            'token' => $pending->token,
        ]);

        Mail::to($pending->email)->send(
            new VerifyRegistrationMail(
                $pending,
                $verificationUrl
            )
        );

        return redirect()->route('verification.notice');
    }

    public function verificationNotice()
    {
        $email = session('verification_email');

        if (!$email) {
            return redirect()->route('cust.register')
                ->with(
                    'error', 
                    'Silakan melakukan pendaftaran terlebih dahulu.'
                );
        }

        return view('auth.verify-email', [
            'email' => $email,
        ]);
    }

    public function verifyRegistration($token)
    {
        $pending = pending_registration::where('token', $token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$pending) {
            return redirect()->route('cust.login')
                ->with('error', 'Link verifikasi tidak valid atau sudah kedaluwarsa.');
        }

        User::create([
            'username' => $pending->username,
            'nama' => $pending->nama,
            'email' => $pending->email,
            'no_telp' => $pending->no_telp,
            'password' => $pending->password,
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        $pending->delete();

        return redirect()->route('cust.login')
            ->with('success', 'Email berhasil diverifikasi. Akun Anda telah dibuat.');
    }

    public function resendVerification(Request $request)
    {
        $email = session('verification_email');

        if (!$email) {
            return redirect()
                ->route('cust.register')
                ->with('error', 'Sesi verifikasi tidak ditemukan.');
        }

        $pending = pending_registration::where('email', $email)->first();

        if (!$pending) {
            return redirect()
                ->route('cust.register')
                ->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $token = Str::random(64);

        $pending->update([
            'token' => $token,
            'expires_at' => now()->addMinutes(30),
        ]);

        $verificationUrl = route('verification.verify', [
            'token' => $token,
        ]);

        Mail::to($pending->email)->send(
            new VerifyRegistrationMail(
                $pending,
                $verificationUrl
            )
        );

        return back()->with(
            'success',
            'Link verifikasi baru telah dikirim ke email Anda.'
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