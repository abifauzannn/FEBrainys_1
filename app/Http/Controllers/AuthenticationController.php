<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{

    public function showLoginForm()
    {
        return view('authentications.login');
    }

    public function showSignupForm()
    {
        return view('authentications.signup');
    }

    public function showProfileForm()
    {
        return view('authentications.profile');
    }

    public function showEmailVerify()
    {
        return view('authentications.emailVerify');
    }

    public function showChangePassword()
    {
        return view('authentications.changePassword');
    }

    public function showEmailForget(){
        return view('forgetPasswords.emailVerify');
    }

    public function showForgetPassword(){
        return view('forgetPasswords.forgetPage');
    }

    public function emailVerify(Request $request){
        // Buat permintaan login ke API
        $response = Http::post('https://be.brainys.oasys.id/api/forgot-password', [
            'email' => $request->input('email'),
        ]);

        $responseData = $response->json();

        // Periksa keberhasilan login
        if ($response->successful() && $responseData['status'] === 'success') {
            // Ambil token dari respons API
            $accessToken = $responseData['reset_token'];

            // Simpan email baru di sesi Laravel
            $email = $request->input('email');
            session(['email' => $email, 'access_token' => $accessToken]);

            // Redirect ke halaman dengan pesan sukses dan email yang baru diinput
            return back()->with('success', $responseData['message'])->with('email', $email, 'access_token', $accessToken);
        } else {
            // Tangani kesalahan login
            return back()->with('error', $responseData['message']);
        }
    }




    public function changeProfile(Request $request)
    {
        $accessToken = Session::get('access_token');

        if (!$accessToken) {
            return redirect()->route('login')->withErrors(['error' => 'Token not found. Please verify OTP again.']);
        }

        $response = Http::withToken($accessToken)->post('https://be.brainys.oasys.id/api/update-profile', [
            'name' => $request->input('name'),
            'school_name' => $request->input('school_name'),
            'profession' => $request->input('profession'),
        ]);

        $responseData = $response->json();

        if ($response->successful() && $responseData['status'] === 'success') {
            // Perbarui data pengguna di sesi
            $user = session('user');
            $user['name'] = $request->input('name');
            $user['school_name'] = $request->input('school_name');
            $user['profession'] = $request->input('profession');
            session(['user' => $user]);

            return back()->with('success', $responseData['message']);
        } else {
            return back()->with('error', $responseData['message']);
        }
    }



    public function resetPassword(Request $request) {
        // Buat permintaan reset password ke endpoint API
        $response = Http::post('https://be.brainys.oasys.id/api/reset-password', [
            'reset_token' =>   $request->query('token'),
            'new_password' => $request->input('new_password'),
            'new_password_confirmation' => $request->input('new_password_confirmation')
        ]);
        // Periksa keberhasilan reset password
        if ($response->successful()) {
            // Password berhasil direset, hapus email dan token dari sesi
            $request->session()->forget(['reset_token']);
            $responseData = $response->json();

            // Tampilkan pesan kesuksesan di halaman login
            return redirect()->route('login')->with('success', $responseData['message']);
        } else {
             // Gagal mereset password, tangani kesalahan
        $errorResponse = $response->json();
        dd($response->json());

        // Manipulasi pesan kesalahan yang diberikan oleh server
        $errorMessage = $errorResponse['message'];
        if (isset($errorResponse['data']) && isset($errorResponse['data']['new_password'])) {
            // Jika ada pesan kesalahan khusus untuk field new_password, gunakan pesan tersebut
            $errorMessage = $errorResponse['data']['new_password'][0];
        }

        dd($response->json());

        // Tampilkan pesan kesalahan di halaman forget password
        return redirect()->route('forgetPassword')->with('error', $errorMessage);
        }
    }




    public function resendOTP(Request $request)
    {
        $response = Http::post('https://be.brainys.oasys.id/api/resend-otp', [
            'email' => $request->input('email'),
        ]);

        $responseData = $response->json();
        // dd($responseData);

        if ($response->successful() && $responseData['status'] === 'success') {
            // Verifikasi OTP berhasil, simpan token dalam sesi
            // $accessToken = $responseData['data']['token'];
            // session(['access_token' => $accessToken]);

            // dd($responseData);

            // Redirect ke halaman melengkapi profil
            $email = $request->input('email');
            $otp = $responseData['data']['otp'];
            return redirect()->route('verify.otp', compact('email', 'otp'));
        } else {
            $errorMessage = isset($responseData['message']) ? $responseData['message'] : 'OTP verification failed. Please try again.';

            return back()->withErrors(['error' => $errorMessage]);
        }
    }




    public function checkEmail(Request $request)
    {
        // Ambil email pengguna yang sedang login dari sesi
        $loggedInUserEmail = Session::get('user.email');

        // Ambil email yang dimasukkan dari permintaan
        $inputEmail = $request->input('email');

        // Bandingkan email yang dimasukkan dengan email pengguna yang sedang login
        if ($inputEmail === $loggedInUserEmail) {
            // Redirect ke halaman change password jika email sesuai
            return redirect()->route('change-password');
        } else {
            return back()->with(['error' => 'Email does not match the logged-in user.'], 400);
        }
    }

    public function changePassword(Request $request)
    {
        $apiUrl = 'https://be.brainys.oasys.id/api/change-password';

        // Ambil token dari sesi Laravel
        $accessToken = Session::get('access_token');

        // Buat permintaan ke endpoint change-password
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->post($apiUrl, [
            'current_password' => $request->input('current_password'),
            'new_password' => $request->input('new_password'),
            'new_password_confirmation' => $request->input('new_password_confirmation'),
        ]);

        // Periksa keberhasilan permintaan
        if ($response->successful() && $response->json()['status'] === 'success') {
            $successMessage = $response->json()['message'] ?? 'Password changed successfully.';
            return back()->with('success', $successMessage);
        } else {
            // Tampilkan respons JSON apabila terjadi kesalahan
            $responseData = $response->json();

            // Tangani kesalahan ganti password
            if (isset($responseData['message']) && $responseData['message'] === 'Current password tidak sesuai.') {
                $errorMessage = 'Password Saat ini tidak sesuai.';
            } else {
                $errorMessage = $responseData['message'] ?? 'Failed to change password.';
            }

            return back()->withErrors(['error' => $errorMessage]);
        }
    }






    public function showVerificationForm(Request $request)
    {
        $email = $request->query('email');
        $otp = $request->query('otp');
        $id = $request->query('id');

        return view('authentications.otp', compact('email', 'otp', 'id'));
    }

    public function completeProfile(Request $request)
    {
        // Pastikan token tersedia dalam sesi
        $accessToken = session('access_token');

        if (!$accessToken) {
            return redirect()->route('login')->withErrors(['error' => 'Token not found. Please verify OTP again.']);
        }

        // Panggil API untuk melengkapi profil dengan menggunakan token
        $response = Http::withToken($accessToken)->post('https://be.brainys.oasys.id/api/profile', [
            'name' => $request->input('name'),
            'school_name' => $request->input('school_name'),
            'profession' => $request->input('profession'),
        ]);

        $responseData = $response->json();

        // Periksa keberhasilan API request
        if ($response->successful() && $responseData['status'] === 'success') {
            // Simpan data pengguna ke sesi
            session(['user' => $responseData['data']['user']]);

            // Redirect ke halaman dashboard
            return redirect()->route('dashboard')->with('success', 'Profile completed successfully');
        } else {
            // Tangani kesalahan API request
            $errorMessage = isset($responseData['message']) ? $responseData['message'] : 'Profile completion failed. Please try again.';
            return back()->withErrors(['error' => $errorMessage]);
        }
    }


    public function verifyOTP(Request $request)
    {
        $response = Http::post('https://be.brainys.oasys.id/api/verify-otp', [
            'email' => $request->input('email'),
            'otp' => $request->input('otp'),
        ]);

        $responseData = $response->json();

        if ($response->successful() && $responseData['status'] === 'success') {
            // Verifikasi OTP berhasil, simpan token dalam sesi
            $accessToken = $responseData['data']['token'];
            session(['access_token' => $accessToken]);

            // Redirect ke halaman melengkapi profil
            return redirect()->route('profileForm');
        } else {
            $errorMessage = isset($responseData['message']) ? $responseData['message'] : 'OTP verification failed. Please try again.';
            return back()->withErrors(['error' => $errorMessage]);
        }
    }


    public function register(Request $request)
    {
        $response = Http::post('https://be.brainys.oasys.id/api/register', [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'password_confirmation' => $request->input('password_confirmation'),
        ]);

        $responseData = $response->json();

        if ($response->successful() && $responseData['status'] === 'success') {
            // Registrasi berhasil, ambil data user dan kirim OTP
            $userData = $responseData['data']['user'];
            $email = $userData['email'];
            $otp = $userData['otp'];
            // Lakukan logika untuk mengirim OTP (contoh: kirim email, simpan di database, dll.)
            // Implementasikan fungsi untuk mengirim OTP sesuai kebutuhan proyek Anda

            // Redirect atau tampilkan halaman untuk memasukkan OTP
            return redirect()->route('verify.otp', compact('email', 'otp'));
        } else {
            if (isset($responseData['data']['email'][0])) {
                // Jika email sudah digunakan, tampilkan pesan kesalahan pada halaman registrasi
                return back()->withErrors(['email' => $responseData['data']['email'][0]]);
            }

            if (isset($responseData['data']['password'][0])) {
                // Jika terdapat kesalahan pada password, tampilkan pesan kesalahan pada halaman registrasi
                return back()->withErrors(['password' => $responseData['data']['password'][0]]);
            }

            return back()->with('error', $responseData['message']);
        }
    }


    public function login(Request $request)
    {
        // Buat permintaan login ke API
        $response = Http::post('https://be.brainys.oasys.id/api/login', [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        $responseData = $response->json();

        // Periksa keberhasilan login
        if ($response->successful() && $responseData['status'] === 'success') {
            // Ambil token dari respons API
            $accessToken = $responseData['data']['token'];

            // Buat objek pengguna untuk menyimpan dalam sesi (tanpa database)
            $user = $responseData['data']['user'];

            // Simpan token dan objek pengguna di sesi Laravel
            session(['access_token' => $accessToken, 'user' => $user]);

            // Redirect ke halaman dashboard atau halaman setelah login
            return redirect()->route('dashboard');
        } else {
            // Tangani kesalahan login
            $errorMessage = isset($responseData['message']) ? $responseData['message'] : 'Login failed. Please check your credentials.';
            return back()->withErrors(['email' => $errorMessage]);
        }
    }


    public function logout()
    {
        // Hapus data sesi
        Session::forget(['access_token', 'user']);

        // Redirect ke halaman login
        return redirect('/login');
    }

    public function redirectToGoogle()
    {
        // Mengarahkan pengguna langsung ke URL pilihan akun Google
        return redirect('https://be.brainys.oasys.id/api/login/google/');
    }

    public function handleGoogleCallback(Request $request)
    {
        // Dapatkan semua parameter dari URL
        $allParameters = $request->all();

        // Inisialisasi objek GuzzleHttp\Client
        $client = new Client();

        // Tentukan URL callback dengan menyertakan semua parameter
        $callbackUrl = 'https://be.brainys.oasys.id/api/login/google/callback?' . http_build_query($allParameters);

        // Lakukan permintaan GET ke endpoint callback
        $response = $client->get($callbackUrl);

        // Ambil dan manipulasi data JSON dari respons
        $result = json_decode($response->getBody(), true);

        // Buat permintaan profile
        $profile = Http::withToken($result['token'])->get('https://be.brainys.oasys.id/api/user-profile');
        // $profile = $profile->json();
        $profileData = json_decode($profile->getBody(), true);

        // dd($result);
        // dd($profileData['data']);

        if ($result['token']) {
            // Simpan token dan objek pengguna di sesi Laravel
            session(['access_token' => $result['token'], 'user' => $profileData['data']]);

            // Redirect ke halaman dashboard atau halaman setelah login
            if ($profileData['data']['name'] == null || $profileData['data']['profession'] == null || $profileData['data']['school_name'] == null) {
                return redirect()->route('profileForm');
            } else {
                return redirect()->route('dashboard');
            }
        } else {
            // Menggunakan withErrors untuk menyimpan pesan kesalahan dalam sesi
            return redirect()->route('login')->withErrors(['error' => $result['message']]);
        }
    }
}
