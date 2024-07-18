<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class KisiKisiController extends Controller
{
    public function kisi(){
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            // Panggil method getUserLimit() untuk mendapatkan data batas penggunaan
            // $userLimit = $this->getUserLimit();

            // Teruskan data pengguna dan batas penggunaan ke view
            return view('generates.generateKisi', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }

    public function getFases()
    {
        try {
            $response = Http::get('https://testing.brainys.oasys.id/api/capaian-pembelajaran/fase');
            $data = $response->json();
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from API.'], 500);
        }
    }

    public function getSubjects(Request $request)
    {
        $fase = $request->query('fase');

        try {
            $response = Http::get('https://testing.brainys.oasys.id/api/capaian-pembelajaran/mata-pelajaran', [
                'fase' => $fase,
            ]);
            $data = $response->json();
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from API.'], 500);
        }
    }

    public function getElements(Request $request)
    {
        $fase = $request->query('fase');
        $mataPelajaran = $request->query('mata_pelajaran');

        try {
            $response = Http::get('https://testing.brainys.oasys.id/api/capaian-pembelajaran/element', [
                'fase' => $fase,
                'mata_pelajaran' => $mataPelajaran,
            ]);
            $data = $response->json();
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data from API.'], 500);
        }
    }

    public function generateKisi(Request $request){

        // Check if the user is authenticated
        if (!session()->has('access_token') || !session()->has('user')) {
            // If not authenticated, redirect to login page
            return redirect('/login')->with('error', 'Please log in to generate syllabus.');
        }

        // Panggil method getUserLimit() untuk mendapatkan data batas penggunaan
        $userLimit = $this->getUserLimit();

        $generateId = null; // Initialize $generateId variable

        if ($request->isMethod('post')) {
            // Form submission

            // Use the authentication token for API request
            $token = session()->get('access_token');

            $response = Http::withToken($token)
                ->timeout(60) // timeout dalam detik (contoh: 60 detik)
                ->post(env('APP_API').'/hint/generate', [
                 'name' => $request->input('name'),
                 'pokok_materi' => $request->input('pokok_materi'),
                 'grade' => $request->input('fase'),
                 'subject' => $request->input('mata-pelajaran'),
                 'elemen_capaian' => $request->input('element'),
                 'jumlah_soal' => $request->input('jumlah_soal'),
                 'notes' => $request->input('notes')

                ]);

            $statusCode = $response->status();
            $responseData = $response->json();

            if ($response->successful()) {
                // Process the API response body
                if (isset($responseData['data'])) {
                    $data = $responseData['data'];
                    $generateId = $responseData['data']['id'];
                } else {
                    // Handle the case where the expected structure is not present in the API response
                    return redirect('/generate-kisi-kisi')->with('error', 'Invalid API response format');
                }
            } else {
                 // Handle error if needed
            if(isset($responseData['status']) && $responseData['status'] === 'failed' && isset($responseData['message'])) {
                return redirect('/generate-kisi-kisi')->with('error', $responseData['message']);
            } else {
                return redirect('/dashboard')->with('error', 'Failed to generate syllabus. Status code: ' . $statusCode);
            }
            }
        } else {
            // Initial form display
            $data = null;
        }

        // Pass the $data and $generateId variables to the view
        return view('outputGenerates.outputKisi', compact('data', 'generateId', 'userLimit'));
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

public function exportToWord(Request $request)
{
    // Ambil generate_id dari permintaan
    $generateId = $request->input('generate_id');

    // Buat permintaan HTTP ke API untuk mengunduh dokumen Word
    $response = Http::withToken(session()->get('access_token'))
                    ->post(env('APP_API').'/hint/export-word', [
                        'id' => $generateId
                    ]);

    // Periksa apakah permintaan berhasil
    if ($response->successful()) {
        // Ambil URL unduhan dari respons
        $downloadUrl = $response->json()['data']['download_url'];

        // Arahkan pengguna ke URL unduhan
        return redirect($downloadUrl);
    } else {
        dd($response->json());
        return back()->with('error', 'Failed to export to Word.');
    }
}

public function exportToExcel(Request $request)
{
    // Ambil generate_id dari permintaan
    $generateId = $request->input('generate_id');

    // Buat permintaan HTTP ke API untuk mengunduh dokumen Word
    $response = Http::withToken(session()->get('access_token'))
                    ->post(env('APP_API').'/hint/export-excel', [
                        'id' => $generateId
                    ]);

    // Periksa apakah permintaan berhasil
    if ($response->successful()) {
        // Ambil URL unduhan dari respons
        $downloadUrl = $response->json()['data']['download_url'];

        // Arahkan pengguna ke URL unduhan
        return redirect($downloadUrl);
    } else {
        dd($response->json());
        return back()->with('error', 'Failed to export to Word.');
    }
}

public function getDetailKisi($id){
    // Check if the user is authenticated
    if (!session()->has('access_token') || !session()->has('user')) {
        // If not authenticated, redirect to login page
        return redirect('/login')->with('error', 'Please log in to fetch material history.');
    }

    // Use the authentication token for API request
    $token = session()->get('access_token');

    $response = Http::withToken($token)
        ->timeout(60) // timeout dalam detik (contoh: 60 detik)
        ->get(env('APP_API').'/hint/history/' . $id);

    $statusCode = $response->status();
    $responseData = $response->json();

    if ($response->successful()) {
        // Process the API response body
        if (isset($responseData['data']['generate_output'])) {
            $data = $responseData['data'];
            // Load view to display material history details
            return view('detailHistory.kisikisi', compact('data'));
        } else {
            // Handle the case where the expected structure is not present in the API response
            return redirect('/history')->with('error', $responseData['message']);
        }
    } else {
        // Handle error if needed
        if (isset($responseData['status']) && $responseData['status'] === 'failed' && isset($responseData['message'])) {
           dd($responseData);
        } else {
           dd($responseData);
        }
    }
}

}
