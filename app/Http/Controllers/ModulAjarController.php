<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ModulAjarController extends Controller
{
    public function modulAjar()
    {
        // Periksa apakah kunci 'user' ada dalam sesi
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            // Teruskan data pengguna dan batas penggunaan ke view
            return view('generates.generateModulAjar', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }

    public function generateModulAjar(Request $request)
    {
        // Check if the user is authenticated
        if (!session()->has('access_token') || !session()->has('user')) {
            // If not authenticated, redirect to login page
            return redirect('/login')->with('error', 'Please log in to generate syllabus.');
        }

        // Panggil method getUserLimit() untuk mendapatkan data batas penggunaan
        $userLimit = $this->getUserLimit();

        $generateId = null; // Initialize $generateId variable
        $data = null; // Initialize $data variable

        if ($request->isMethod('post')) {
            // Form submission

            // Use the authentication token for API request
            $token = session()->get('access_token');

            // Define cache key
            $cacheKey = 'modul_ajar_' . md5(json_encode($request->all()));

            // Check if data is cached
            $cachedResponse = Cache::get($cacheKey);

            if (!$cachedResponse) {
                // If not cached, make the API request
                $response = Http::withToken($token)
                    ->timeout(60) // timeout dalam detik (contoh: 60 detik)
                    ->post(env('APP_API').'/modul-ajar/generate', [
                        'name' => $request->input('name'),
                        'phase' => $request->input('fase'),
                        'subject' => $request->input('mata-pelajaran'),
                        'element' => $request->input('element'),
                        'notes' => $request->input('notes')
                    ]);

                $statusCode = $response->status();
                $responseData = $response->json();

                if ($response->successful()) {
                    // Process the API response body
                    if (isset($responseData['data'])) {
                        $data = $responseData['data'];
                        $generateId = $data['id'];

                        // Cache the successful response
                        Cache::put($cacheKey, $responseData, now()->addMinutes(10));
                    } else {
                        // Handle the case where the expected structure is not present in the API response
                        return redirect('/generate-modul-ajar')->with('error', 'Invalid API response format');
                    }
                } else {
                    // Handle error if needed
                    if (isset($responseData['status']) && $responseData['status'] === 'failed' && isset($responseData['message'])) {
                        return redirect('/generate-modul-ajar')->with('error', $responseData['message']);
                    } else {
                        return redirect('/dashboard')->with('error', 'Failed to generate syllabus. Status code: ' . $statusCode);
                    }
                }
            } else {
                // Use cached data
                $data = $cachedResponse['data'];
                $generateId = $data['id'];
            }
        }

        // Pass the $data and $generateId variables to the view
        return view('outputGenerates.outputModulAjar', compact('data', 'generateId', 'userLimit'));
    }




public function exportToWord(Request $request)
{
    // Ambil generate_id dari permintaan
    $generateId = $request->input('generate_id');

    // Buat permintaan HTTP ke API untuk mengunduh dokumen Word
    $response = Http::withToken(session()->get('access_token'))
                    ->post(env('APP_API').'/modul-ajar/export-word', [
                        'id' => $generateId
                    ]);

    // Periksa apakah permintaan berhasil
    if ($response->successful()) {
        // Ambil URL unduhan dari respons
        $downloadUrl = $response->json()['data']['download_url'];

        // Arahkan pengguna ke URL unduhan
        return redirect($downloadUrl);
    } else {

        return back()->with('error', 'Failed to export to Word.');
    }
}

public function exportToExcel(Request $request)
{
    // Ambil generate_id dari permintaan
    $generateId = $request->input('generate_id');

    // Buat permintaan HTTP ke API untuk mengunduh dokumen Word
    $response = Http::withToken(session()->get('access_token'))
                    ->post(env('APP_API').'/modul-ajar/export-excel', [
                        'id' => $generateId
                    ]);

    // Periksa apakah permintaan berhasil
    if ($response->successful()) {
        // Ambil URL unduhan dari respons
        $downloadUrl = $response->json()['data']['download_url'];

        // Arahkan pengguna ke URL unduhan
        return redirect($downloadUrl);
    } else {

        return back()->with('error', 'Failed to export to Word.');
    }
}

public function getUserLimit()
{
    // Lakukan HTTP request untuk mendapatkan data status pengguna
    $response = Http::withToken(session()->get('access_token'))
                    ->get(env('APP_API').'/user-status');

    // Periksa apakah permintaan HTTP sukses
    if ($response->successful()) {
        // Mengembalikan data status pengguna
        return $response->json()['data'];
    } else {
        // Tangani kasus jika permintaan HTTP gagal
        return null;
    }
}

public function getDetailModulAjar($idModul){
    // Check if the user is authenticated
    if (!session()->has('access_token') || !session()->has('user')) {
        // If not authenticated, redirect to login page
        return redirect('/login')->with('error', 'Please log in to fetch material history.');
    }

    // Panggil method getUserLimit() untuk mendapatkan data batas penggunaan
    $userLimit = $this->getUserLimit();

    // Use the authentication token for API request
    $token = session()->get('access_token');

    $response = Http::withToken($token)
        ->timeout(60) // timeout dalam detik (contoh: 60 detik)
        ->get(env('APP_API').'/modul-ajar/history/' . $idModul);

    $statusCode = $response->status();
    $responseData = $response->json();

    if ($response->successful()) {
        // Process the API response body
        if (isset($responseData['data']['output_data'])) {
            $materialHistory = $responseData['data'];
            // Load view to display material history details
            return view('detailHistory.modulAjar', compact('materialHistory', 'userLimit'));
        } else {
            // Handle the case where the expected structure is not present in the API response
            return redirect('/history')->with('error', $responseData['message']);
        }
    } else {
        // Handle error if needed
        if (isset($responseData['status']) && $responseData['status'] === 'failed' && isset($responseData['message'])) {
           dd($responseData);
        } else {
            return redirect('/history')->with('error', 'Failed to fetch material history. Status code: ' . $statusCode);
        }
    }
}




}
