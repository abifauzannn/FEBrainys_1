<?php

use App\Http\Controllers\AtpController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BahanAjarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EssayController;
use App\Http\Controllers\GamifikasiController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\KisiKisiController;
use App\Http\Controllers\ModulAjarController;
use App\Http\Controllers\SyllabusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('authentications.login');
});

Route::get('/signup', function () {
    return view('authentications.signup');
});


Route::get('/generate', function () {
    return view('syllabus.generate');
});

Route::get('/user', function () {
    return view('profiles.user');
});

Route::get('/email-verify', function () {
    return view('profiles.emailVerify');
});

Route::get('/change-password', function () {
    return view('profiles.changePassword');
});

Route::get('/login', function () {
    return view('authentications.login');
})->name('login');

Route::get('/verify-otp', [AuthenticationController::class, 'showVerificationForm'])->name('verify.otp');
Route::post('/verify-otp', [AuthenticationController::class, 'verifyOTP'])->name('verify.otp.post');

// Route untuk melakukan login dan autentikasi dengan menggunakan API
Route::post('/login', [AuthenticationController::class, 'login']);
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

// Google Auth
Route::get('/login/google', [AuthenticationController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [AuthenticationController::class, 'handleGoogleCallback']);
Route::get('/login/google-forwarder', [AuthenticationController::class, 'handleGoogleCallback']);

// Route untuk menampilkan halaman dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('/generate-modul-ajar', [ModulAjarController::class, 'modulAjar'])->name('modulAjar');
Route::post('/generate-modul-ajar', [ModulAjarController::class, 'generateModulAjar'])->name('modulAjarPost');
Route::get('/generate-modul-ajar/generate-output', [ModulAjarController::class, 'modulAjar'])->name('outputModulAjar');

Route::get('/generate-bahan-ajar', [BahanAjarController::class, 'bahanAjar'])->name('bahanAjar');
Route::post('/generate-bahan-ajar', [BahanAjarController::class, 'generateBahanAjar'])->name('bahanAjarPost');
Route::get('/generate-gamifikasi', [GamifikasiController::class, 'gamifikasi'])->name('gamifikasi');
Route::get('/generate-kisi-kisi', [KisiKisiController::class, 'kisi'])->name('kisi');
Route::get('/generate-atp', [AtpController::class, 'atp'])->name('atp');
Route::get('/generate-gamifikasi', [GamifikasiController::class, 'gamifikasi'])->name('gamifikasi');

Route::post('/export-word', [ModulAjarController::class, 'exportToWord'])->name('export-word');
Route::post('/export-word-syllabus', [SyllabusController::class, 'exportToWord'])->name('export-word-syllabus');
Route::post('/export-essay', [EssayController::class, 'exportToWord'])->name('export-essay');
Route::post('/export-bahan-ajar', [BahanAjarController::class, 'exportToWord'])->name('export-bahan-ajar');
Route::post('/export-bahan-ajar-ppt', [BahanAjarController::class, 'exportToPpt'])->name('export-bahanAjar-ppt');
Route::post('/export-gamifikasi-word', [GamifikasiController::class, 'exportToWord'])->name('export-gamifikasi-word');
Route::post('/export-gamifikasi-ppt', [GamifikasiController::class, 'exportToPpt'])->name('export-gamifikasi-ppt');
Route::post('/generate-gamifikasi', [GamifikasiController::class, 'generateGamifikasi'])->name('gamifikasiPost');


Route::post('/register', [AuthenticationController::class, 'register'])->name('registerPost');
Route::get('/register', [AuthenticationController::class, 'showSignupForm'])->name('showSignupForm');

Route::get('/profile', [AuthenticationController::class, 'showProfileForm'])->name('profileForm');
Route::post('/profile', [AuthenticationController::class, 'completeProfile'])->name('complete.profile');

Route::get('/email-verify-change', [AuthenticationController::class, 'showEmailVerify'])->name('emailVerifyChange');

Route::get('/email-forget-verify', [AuthenticationController::class, 'showEmailForget'])->name('emailForget');
Route::post('/email-forget-verify', [AuthenticationController::class, 'emailVerify'])->name('emailVerify');
Route::get('/forget-password', [AuthenticationController::class, 'showForgetPassword'])->name('forgetPassword');
Route::post('/forget-password', [AuthenticationController::class, 'resetPassword'])->name('resetPassword');

Route::get('/change-password', [AuthenticationController::class, 'showChangePassword'])->name('change-password');
Route::post('/change-password', [AuthenticationController::class, 'changePassword'])->name('change-passwordPost');

Route::post('/change-profile', [AuthenticationController::class, 'changeProfile'])->name('change-profilePost');

Route::post('/check-email', [AuthenticationController::class, 'checkEmail'])->name('checkEmail');

Route::get('/user-profile', [UserController::class, 'showProfile'])->name('userProfile');

Route::post('/resend-otp', [AuthenticationController::class, 'resendOTP'])->name('resend-otp');

Route::get('/history', [HistoryController::class, 'showAllHistory'])->name('history');
Route::get('/history/modul-ajar/{idModul}', [ModulAjarController::class, 'getDetailModulAjar'])->name('detailModulAjar');
Route::get('/history/syllabus/{idSyllabus}', [SyllabusController::class, 'getDetailSyllabus'])->name('detailSyllabus');
Route::get('/history/exercise/{idExercise}', [EssayController::class, 'getDetailExercise'])->name('detailExercise');

Route::get('/generate-essay', [EssayController::class, 'Essay'])->name('essay');
Route::post('/generate-essay', [EssayController::class, 'generateEssay'])->name('essayPost');

Route::get('/generate-syllabus', [SyllabusController::class, 'syllabus'])->name('syllabus');
Route::post('/generate-syllabus', [SyllabusController::class, 'generateSyllabus'])->name('syllabusPost');

Route::post('/reedem-code', [AuthenticationController::class, 'verifyInvitationCode'])->name('reedemCode');







