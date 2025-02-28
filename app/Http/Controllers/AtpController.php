<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AtpController extends Controller
{
    public function atp(){
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            // Panggil method getUserLimit() untuk mendapatkan data batas penggunaan
            // $userLimit = $this->getUserLimit();

            // Teruskan data pengguna dan batas penggunaan ke view
            return view('generates.generatesAtp', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }

    public function generateAtp(Request $request)
{
    // Check if the user is authenticated
    if (!session()->has('access_token') || !session()->has('user')) {
        return redirect('/login')->with('error', 'Please log in to generate syllabus.');
    }

    $generateId = null; // Initialize $generateId variable
    $responseMessage = null;

    if ($request->isMethod('post')) {
        // Form submission
        $token = session()->get('access_token');

        $response = Http::withToken($token)
            ->timeout(60) // timeout in seconds (example: 60 seconds)
            ->post(env('APP_API').'/atp/generate', [
                'name' => $request->input('name'),
                'phase' => $request->input('fase'),
                'subject' => $request->input('mata-pelajaran'),
                'element' => $request->input('element'),
                'weeks' => $request->input('pekan'),
                'notes' => $request->input('notes')
            ]);

        $statusCode = $response->status();
        $responseData = $response->json();

        if ($response->successful()) {
            if (isset($responseData['data'])) {
                $data = $responseData['data'];
                $generateId = $responseData['data']['id'];
                $responseMessage = 'ATP generated successfully!';
                session()->flash('success', $responseMessage);
                session()->flash('data', $data);
                session()->flash('generateId', $generateId);
            } else {
                session()->flash('error', 'Invalid API response format');
            }
        } else {
            if (isset($responseData['status']) && $responseData['status'] === 'failed' && isset($responseData['message'])) {
                session()->flash('error', $responseData['message']);
            } else {
                session()->flash('error', 'Failed to generate ATP. Status code: ' . $statusCode);
            }
        }

        return redirect('/generate-atp');
    } else {
        // Initial form display
        $data = null;
    }

    // Pass the $data and $generateId variables to the view
    return view('outputGenerates.outputAtp', compact('data', 'generateId'));
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
                    ->post(env('APP_API').'/atp/export-word', [
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
                    ->post(env('APP_API').'/atp/export-excel', [
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

public function getDetailAtp($id){
    // Check if the user is authenticated
    if (!session()->has('access_token') || !session()->has('user')) {
        // If not authenticated, redirect to login page
        return redirect('/login')->with('error', 'Please log in to fetch material history.');
    }

    // Use the authentication token for API request
    $token = session()->get('access_token');

    $response = Http::withToken($token)
        ->timeout(60) // timeout dalam detik (contoh: 60 detik)
        ->get(env('APP_API').'/atp/history/' . $id);

    $statusCode = $response->status();
    $responseData = $response->json();

    if ($response->successful()) {
        // Process the API response body
        if (isset($responseData['data']['output_data'])) {
            $data = $responseData['data'];
            // Load view to display material history details
            return view('detailHistory.atp', compact('data'));
        } else {
            // Handle the case where the expected structure is not present in the API response
            return redirect('/history')->with('error', $responseData['message']);
        }
    } else {
        // Handle error if needed
        if (isset($responseData['status']) && $responseData['status'] === 'failed' && isset($responseData['message'])) {

            return redirect('/history')->with('error', $responseData['message']);
        } else {

            return redirect('/history')->with('error', 'Failed to fetch material history. Status code: ' . $statusCode);
        }
    }
}

public function getCreditCharges()
{
    $response = Http::withToken(session()->get('access_token'))
                    ->get(env('APP_API').'/module-credit-charges/alur-tujuan-pembelajaran');

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
