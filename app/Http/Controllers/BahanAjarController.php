<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BahanAjarController extends Controller
{
    public function bahanAjar(){
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            // Panggil method getUserLimit() untuk mendapatkan data batas penggunaan
            // $userLimit = $this->getUserLimit();

            // Teruskan data pengguna dan batas penggunaan ke view
            return view('generates.generateBahanAjar', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }

    public function generateBahanAjar(Request $request)
{
    // Check if the user is authenticated
    if (!session()->has('access_token') || !session()->has('user')) {
        return redirect('/login')->with('error', 'Please log in to generate teaching materials.');
    }

    // Call method getUserLimit() to get user limit data
  

    $generateId = null; // Initialize $generateId variable
    $responseMessage = null;

    if ($request->isMethod('post')) {
        // Form submission
        $token = session()->get('access_token');

        $response = Http::withToken($token)
            ->timeout(60) // timeout in seconds (example: 60 seconds)
            ->post(env('APP_API').'/bahan-ajar/generate', [
                'name' => $request->input('name'),
                'subject' => $request->input('subject'),
                'grade' => $request->input('grade'),
                'notes' => $request->input('notes')
            ]);

        $statusCode = $response->status();
        $responseData = $response->json();

        if ($response->successful()) {
            if (isset($responseData['data'])) {
                $data = $responseData['data'];
                $generateId = $responseData['data']['id'];
                $responseMessage = 'Teaching material generated successfully!';
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
                session()->flash('error', 'Failed to generate teaching materials. Status code: ' . $statusCode);
            }
        }

        return redirect('/generate-bahan-ajar');
    } else {

        $data = null;
    }


    return view('outputGenerates.outputBahanAjar', compact('data', 'generateId'));
}


public function exportToWord(Request $request)
{
    // Ambil generate_id dari permintaan
    $generateId = $request->input('generate_id');

    // Buat permintaan HTTP ke API untuk mengunduh dokumen Word
    $response = Http::withToken(session()->get('access_token'))
                    ->post(env('APP_API').'/bahan-ajar/export-word', [
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

public function exportToPpt(Request $request)
{
    // Ambil generate_id dari permintaan
    $generateId = $request->input('generate_id');

    // Buat permintaan HTTP ke API untuk mengunduh dokumen Word
    $response = Http::withToken(session()->get('access_token'))
                    ->post(env('APP_API').'/bahan-ajar/export-ppt', [
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



public function getDetailBahanAjar($idBahan){
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
        ->get(env('APP_API').'/bahan-ajar/history/' . $idBahan);

    $statusCode = $response->status();
    $responseData = $response->json();

    if ($response->successful()) {
        // Process the API response body
        if (isset($responseData['data']['generate_output'])) {
            $bahanAjarHistory = $responseData['data'];
            // Load view to display material history details
            return view('detailHistory.bahanAjar', compact('bahanAjarHistory', 'userLimit'));
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
