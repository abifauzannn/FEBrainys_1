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
            return view('generates.generateEssay', compact('userData', 'userLimit'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }

    public function generateEssay(Request $request){
        // Pastikan user sudah terautentikasi
        if (!session()->has('access_token') || !session()->has('user')) {
            return redirect('/login')->with('error', 'Please log in to generate syllabus.');
        }

        $userLimit = $this->getUserLimit();
        $generateId = null;

        if ($request->isMethod('post')) {
            // Pengecekan apakah yang dipilih pengguna adalah 'essay' atau 'multiple choice'
            $exerciseType = $request->input('exerciseType');
            $apiEndpoint = '';

            if ($exerciseType === 'essay') {
                $apiEndpoint = 'https://be.brainys.oasys.id/api/exercise/generate-essay';
            } elseif ($exerciseType === 'multiple_choice') {
                $apiEndpoint = 'https://be.brainys.oasys.id/api/exercise/generate-choice';
            } else {
                // Handle error jika pilihan subjek tidak valid
                return redirect('/generate-essay')->with('error', 'Invalid exercise type choice');
            }

            $token = session()->get('access_token');

            $response = Http::withToken($token)
                ->timeout(60)
                ->post($apiEndpoint, [
                    'name' => $request->input('name'),
                    'subject' => $request->input('subject'),
                    'grade' => $request->input('grade'),
                    'number_of_questions' => $request->input('numberOfQuestion'),
                    'notes' => $request->input('notes')
                ]);

            $statusCode = $response->status();
            $responseData = $response->json();

            if ($response->successful()) {
                if (isset($responseData['data'])) {
                    $data = $responseData['data'];
                    $generateId = $responseData['data']['id'];

                } else {
                    return redirect('/generate-essay')->with('error', 'Invalid API response format');
                }
            } else {
                if(isset($responseData['status']) && $responseData['status'] === 'failed' && isset($responseData['message'])) {
                    return redirect('/generate-essay')->with('error', $responseData['message']);
                } else {
                    return redirect('/dashboard')->with('error', 'Failed to generate syllabus. Status code: ' . $statusCode);
                }
            }
        } else {
            $data = null;
        }

        return view('generates.generateEssay', compact('data', 'generateId', 'userLimit'))->with('success', $responseData['message']);
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

public function exportToWord(Request $request)
{
    // Ambil generate_id dari permintaan
   // Ambil generate_id dari permintaan
   $generateId = $request->input('generate_id');

   // Buat permintaan HTTP ke API untuk mengunduh dokumen Word
   $response = Http::withToken(session()->get('access_token'))
                   ->post('https://be.brainys.oasys.id/api/exercise/export-word', [
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
       dd($response->json());
       return back()->with('error', 'Failed to export to Word.');
   }
}

public function getDetailExercise($idExercise){
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
        ->get('https://be.brainys.oasys.id/api/exercise/history/' . $idExercise);

    $statusCode = $response->status();
    $responseData = $response->json();

    if ($response->successful()) {

        if (isset($responseData['data']['output_data'])) {
            $data = $responseData['data'];
            // Load view to display material history details
            return view('detailHistory.exercise', compact('data', 'userLimit'));
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
