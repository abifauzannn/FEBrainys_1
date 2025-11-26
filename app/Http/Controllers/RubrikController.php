<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RubrikController extends Controller
{
    public function index() {
         if (session()->has('user')) {
            $userData = session('user');
            return view('generates.generateRubrik', compact('userData'));
        } else {
            return redirect('/login');
        }
    }

    public function generateRubrik(Request $request)
{
    if (!session()->has('access_token') || !session()->has('user')) {
        return redirect('/login')->with('error', 'Please log in to generate rubric.');
    }

    if ($request->isMethod('post')) {

        $token = session()->get('access_token');
        $dataSource = $request->input('data_source');

        $payload = [
            'name' => $request->input('name'),
            'data_source' => $dataSource,
            'type' => $request->input('type'),
            'notes' => $request->input('notes'),
        ];

        if ($dataSource === 'modul_ajar') {

            $payload['modul_ajar_history_id'] = $request->input('history');

            $payload['phase'] = null;
            $payload['subject'] = null;
            $payload['element'] = null;
            $payload['topik_pembelajaran'] = null;

        } else {

            $payload['modul_ajar_history_id'] = $request->input('history');

            $payload['phase'] = $request->input('fase');
            $payload['subject'] = $request->input('mata-pelajaran');
            $payload['element'] = $request->input('element');
            $payload['topik_pembelajaran'] = $request->input('topik_pembelajaran');
        }

        $response = Http::withToken($token)
            ->timeout(300)
            ->post(env('APP_API') . '/rubrik-nilai/generate', $payload);

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
                return redirect('/generate-rubrik-nilai');
                }
            } else {
                if (isset($responseData['status']) && $responseData['status'] === 'failed' && isset($responseData['message'])) {
                    session()->flash('error', $responseData['message']);
                } else {
                    session()->flash('error', $responseData['message']);
                }
            }

             return redirect('/generate-rubrik-nilai');
    } else {
            // Initial form display
            $data = null;
            $generateId = null;
        }

        return view('outputGenerates.outputRubrik', compact('data', 'generateId'));


}




    public function loadModulHistory()
{
    $response = Http::withToken(session()->get('access_token'))
        ->get(env('APP_API') . '/modul-ajar/history');

    $responseData = $response->json();

    if (!$response->successful()) {
        return response()->json([
            'status' => 'error',
            'message' => $responseData['message'] ?? 'Gagal mengambil data modul ajar.',
            'data' => null
        ], $response->status());
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Riwayat modul ajar berhasil dimuat.',
        'data' => $responseData['data']
    ]);
}

// public function generateRubrik(Request $request)
// {
//     if (!session()->has('access_token') || !session()->has('user')) {
//         return redirect('/login')->with('error', 'Please log in to generate rubric.');
//     }

//     if ($request->isMethod('post')) {

//         $token = session()->get('access_token');
//         $dataSource = $request->input('data_source');

//         $payload = [
//             'name' => $request->input('name'),
//             'data_source' => $dataSource,
//             'type' => $request->input('type'),
//             'notes' => $request->input('notes'),
//             'modul_ajar_history_id' => $request->input('history'),
//         ];

//         if ($dataSource === 'modul_ajar') {
//             $payload['phase'] = null;
//             $payload['subject'] = null;
//             $payload['element'] = null;
//             $payload['topik_pembelajaran'] = null;

//         } else {
//             $payload['phase'] = $request->input('fase');
//             $payload['subject'] = $request->input('mata-pelajaran');
//             $payload['element'] = $request->input('element');
//             $payload['topik_pembelajaran'] = $request->input('topik_pembelajaran');
//         }

//         $response = Http::withToken($token)
//             ->timeout(300)
//             ->post(env('APP_API') . '/rubrik-nilai/generate', $payload);

//         $responseData = $response->json();


//         if ($response->successful()) {

//             if (isset($responseData['data'])) {

//                 $data = $responseData['data'];
//                 $generateId = $responseData['data']['id'];

//                 // 🔥 SIMPAN PERMANEN (tidak hilang saat refresh)
//                 session()->put('success', 'Rubrik berhasil di-generate!');
//                 session()->put('data', $data);
//                 session()->put('generateId', $generateId);

//             } else {
//                 session()->put('error', 'Invalid API response format');
//                 return redirect('/generate-rubrik-nilai');
//             }

//         } else {
//             session()->put('error', $responseData['message'] ?? 'API Error occurred');
//         }

//         return redirect('/generate-rubrik-nilai');
//     }

//     // Ketika halaman diakses GET, hasil generate tetap terbaca jika sudah ada di session
//     $data       = session('data');
//     $generateId = session('generateId');

//     return view('outputGenerates.outputRubrik', compact('data', 'generateId'));
// }


}
