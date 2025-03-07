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

            // Teruskan data pengguna dan batas penggunaan ke view
            return view('generates.generateEssay', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }

    public function generateEssay(Request $request)
{
    // Pastikan user sudah terautentikasi
    if (!session()->has('access_token') || !session()->has('user')) {
        return redirect('/login')->with('error', 'Please log in to generate exercise.');
    }

    $generateId = null;
    $responseMessage = null;

    if ($request->isMethod('post')) {
        // Pengecekan apakah yang dipilih pengguna adalah 'essay' atau 'multiple choice'
        $exerciseType = $request->input('exerciseType');
        $apiEndpoint = '';

        if ($exerciseType === 'essay') {
            $apiEndpoint = env('APP_API').'/exercise-v2/generate-essay';
        } elseif ($exerciseType === 'multiple_choice') {
            $apiEndpoint = env('APP_API').'/exercise-v2/generate-choice';
        } else {
            // Handle error jika pilihan subjek tidak valid
            session()->flash('error', 'Invalid exercise type choice');
            return redirect('/generate-essay');
        }

        $token = session()->get('access_token');

        $response = Http::withToken($token)
            ->timeout(60)
            ->post($apiEndpoint, [
                'name' => $request->input('name'),
                'phase' => $request->input('fase'),
                'element' => $request->input('element'),
                'subject' => $request->input('mata-pelajaran'),
                'number_of_questions' => $request->input('numberOfQuestion'),
                'notes' => $request->input('notes')
            ]);

        $statusCode = $response->status();
        $responseData = $response->json();

        if ($response->successful()) {
            if (isset($responseData['data'])) {
                $data = $responseData['data'];
                $generateId = $responseData['data']['id'];
                $responseMessage = 'Exercise generated successfully!';
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
                session()->flash('error', 'Failed to generate exercise. Status code: ' . $statusCode);
            }
        }

        return redirect('/generate-essay');
    } else {
        $data = null;
    }

    // Menampilkan view dengan flash message jika ada
    return view('outputGenerates.outputExercise', compact('data', 'generateId'));
}

public function exportToWord(Request $request)
{
    // Ambil generate_id dari permintaan
   // Ambil generate_id dari permintaan
   $generateId = $request->input('generate_id');

   // Buat permintaan HTTP ke API untuk mengunduh dokumen Word
   $response = Http::withToken(session()->get('access_token'))
                   ->post(env('APP_API').'/exercise-v2/export-word', [
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

public function getDetailExercise($idExercise){
    if (!session()->has('access_token') || !session()->has('user')) {
        // If not authenticated, redirect to login page
        return redirect('/login')->with('error', 'Please log in to fetch material history.');
    }


    // Use the authentication token for API request
    $token = session()->get('access_token');

    $response = Http::withToken($token)
        ->timeout(60) // timeout dalam detik (contoh: 60 detik)
        ->get(env('APP_API').'/exercise-v2/history/' . $idExercise);

    $statusCode = $response->status();
    $responseData = $response->json();

    if ($response->successful()) {

        if (isset($responseData['data']['output_data'])) {
            $data = $responseData['data'];
            // Load view to display material history details
            return view('detailHistory.exercise', compact('data'));
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
                    ->get(env('APP_API').'/module-credit-charges/soal');

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
