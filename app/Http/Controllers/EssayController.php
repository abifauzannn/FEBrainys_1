<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EssayController extends Controller
{
    public function Essay(){
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            // Panggil method getUserLimit() untuk mendapatkan data batas penggunaan
            $userLimit = $this->getUserLimit();

            // Teruskan data pengguna dan batas penggunaan ke view
            return view('essays.generate', compact('userData', 'userLimit'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }

    public function generateEssay(Request $request){
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
            ->post('https://be.brainys.oasys.id/api/exercise/generate-essay', [
                'name' => $request->input('name'),
                'subject' => $request->input('subject'),
                'grade' => $request->input('grade'),
                'number_of_questions' => $request->input('numberOfQuestion'),
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
                return redirect('/generate-essay')->with('error', 'Invalid API response format');
            }
        } else {
             // Handle error if needed
        if(isset($responseData['status']) && $responseData['status'] === 'failed' && isset($responseData['message'])) {
            return redirect('/generate-essay')->with('error', $responseData['message']);
        } else {
            return redirect('/dashboard')->with('error', 'Failed to generate syllabus. Status code: ' . $statusCode);
        }
        }
    } else {
        // Initial form display
        $data = null;
    }

    // Pass the $data and $generateId variables to the view
    return view('essays.generate', compact('data', 'generateId', 'userLimit'));
    }


    public function getUserLimit()
{
    // Lakukan HTTP request untuk mendapatkan data status pengguna
    $response = Http::withToken(session()->get('access_token'))
                    ->get('https://be.brainys.oasys.id/api/user-status');

    // Periksa apakah permintaan HTTP sukses
    if ($response->successful()) {
        // Mengembalikan data status pengguna
        return $response->json()['data'];
    } else {
        // Tangani kasus jika permintaan HTTP gagal
        return null;
    }
}
}
