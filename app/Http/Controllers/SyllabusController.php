<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SyllabusController extends Controller
{
    public function syllabus(){
         // Periksa apakah kunci 'user' ada dalam sesi
         if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            // Teruskan data pengguna dan batas penggunaan ke view
            return view('generates.generateSyllabus', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
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

public function generateSyllabus(Request $request)
{
    // Check if the user is authenticated
    if (!session()->has('access_token') || !session()->has('user')) {
        // If not authenticated, redirect to login page
        return redirect('/login')->with('error', 'Please log in to generate syllabus.');
    }

    $generateId = null;
    $responseMessage = null;

    if ($request->isMethod('post')) {
        // Use the authentication token for API request
        $token = session()->get('access_token');

        $response = Http::withToken($token)
            ->timeout(60) // timeout in seconds (example: 60 seconds)
            ->post(env('APP_API').'/syllabus/generate', [
                'subject' => $request->input('subject'),
                'grade' => $request->input('grade'),
                'nip' => $request->input('nip'),
                'notes' => $request->input('notes')
            ]);

        $statusCode = $response->status();
        $responseData = $response->json();

        if ($response->successful()) {
            // Process the API response body
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
                return redirect('/generate-syllabus');
            }
        } else {
            // Handle error if needed
            if (isset($responseData['status']) && $responseData['status'] === 'failed' && isset($responseData['message'])) {
                session()->flash('error', $responseData['message']);
            } else {
                session()->flash('error', 'Failed to generate syllabus. Status code: ' . $statusCode);
            }
        }

        return redirect('/generate-syllabus');
    } else {
        $data = null;
    }

    // Pass the $data and $generateId variables to the view
    return view('outputGenerates.syllabusOutput', compact('data', 'generateId'));
}


public function exportToWord(Request $request)
{
    // Ambil generate_id dari permintaan
    $generateId = $request->input('generate_id');

    // Buat permintaan HTTP ke API untuk mengunduh dokumen Word
    $response = Http::withToken(session()->get('access_token'))
                    ->post(env('APP_API').'/syllabus/export-word', [
                        'id' => $generateId
                    ]);

    // Periksa apakah permintaan berhasil
    if ($response->successful()) {
        // Ambil URL unduhan dari respons
        $downloadUrl = $response->json()['data']['download_url'];

        // Arahkan pengguna ke URL unduhan
        return redirect($downloadUrl);
    } else {
        // Tangani kasus jika permintaan gagal

        return back()->with('error', 'Failed to export to Word.');
    }
}

public function getDetailSyllabus($idSyllabus){
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
        ->get(env('APP_API').'/syllabus/history/' . $idSyllabus);

    $statusCode = $response->status();
    $responseData = $response->json();

    if ($response->successful()) {

        if (isset($responseData['data']['generate_output'])) {
            // Process the API response body
            $data = $responseData['data'];
            return view('detailHistory.syllabus', compact('data', 'userLimit'));
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

}
