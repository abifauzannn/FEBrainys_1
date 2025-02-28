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
        ini_set('max_execution_time', 300);
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



        if ($request->isMethod('post')) {
            // Form submission
            $token = session()->get('access_token');

            $response = Http::withToken($token)
                ->timeout(300)
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
                if (isset($responseData['data'])) {
                $data = $responseData['data'];
                $generateId = $responseData['data']['id'];
                $responseMessage = 'Syllabus generated successfully!';
                session()->flash('success', $responseMessage);
                session()->flash('data', $data);
                session()->flash('generateId', $generateId);
                } else {
                     // Handle the case where the expected structure is not present in the API response
                session()->flash('error', 'Invalid API response format');
                return redirect('/generate-modul-ajar');
                }
            } else {
                if (isset($responseData['status']) && $responseData['status'] === 'failed' && isset($responseData['message'])) {
                    session()->flash('error', $responseData['message']);
                } else {
                    dd($response);
                }
            }

            return redirect('/generate-modul-ajar');
        } else {
            // Initial form display
            $data = null;
            $generateId = null;
        }

        return view('outputGenerates.outputModulAjar', compact('data', 'generateId'));
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

public function getDetailModulAjar($idModul){
    // Check if the user is authenticated
    if (!session()->has('access_token') || !session()->has('user')) {
        // If not authenticated, redirect to login page
        return redirect('/login')->with('error', 'Please log in to fetch material history.');
    }

    // Panggil method getUserLimit() untuk mendapatkan data batas penggunaan

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
            return view('detailHistory.modulAjar', compact('materialHistory'));
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

public function getCreditCharges()
{
    $response = Http::withToken(session()->get('access_token'))
                    ->get(env('APP_API').'/module-credit-charges/modul-ajar');

    $responseData = $response->json();

    if ($response->successful() && isset($responseData['data'])) {
        return response()->json([
            'success' => true,
            'credit_charged_generate' => $responseData['data']['credit_charged_generate']
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Gagal mengambil data credit charges'
        ]);
    }
}






}
