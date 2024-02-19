<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SyllabusController extends Controller
{
    public function syllabus()
    {
        // Periksa apakah kunci 'user' ada dalam sesi
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            return view('syllabus.generate', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }


    public function generateSyllabus(Request $request)
    {
        // Check if the user is authenticated
        if (!session()->has('access_token') || !session()->has('user')) {
            // If not authenticated, redirect to login page
            return redirect('/login')->with('error', 'Please log in to generate syllabus.');
        }

        $generateId = null; // Initialize $generateId variable

        if ($request->isMethod('post')) {
            // Form submission

            // Use the authentication token for API request
            $token = session()->get('access_token');

            $response = Http::withToken($token)
                ->timeout(60) // timeout dalam detik (contoh: 60 detik)
                ->post('https://be.brainys.oasys.id/api/material/generate', [
                    'name' => $request->input('name'),
                    'subject' => $request->input('subject'),
                    'grade' => $request->input('grade'),
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
                    return redirect('/generate')->with('error', 'Invalid API response format');
                }
            } else {
                 // Handle error if needed
            if(isset($responseData['status']) && $responseData['status'] === 'failed' && isset($responseData['message'])) {
                return redirect('/generate')->with('error', $responseData['message']);
            } else {
                return redirect('/dashboard')->with('error', 'Failed to generate syllabus. Status code: ' . $statusCode);
            }
            }
        } else {
            // Initial form display
            $data = null;
        }

        // Pass the $data and $generateId variables to the view
        return view('syllabus.generate', compact('data', 'generateId'));
    }



public function exportToWord(Request $request)
{
    // Ambil generate_id dari permintaan
    $generateId = $request->input('generate_id');

    // Buat permintaan HTTP ke API untuk mengunduh dokumen Word
    $response = Http::withToken(session()->get('access_token'))
                    ->post('https://be.brainys.oasys.id/api/material/export-word', [
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



}
