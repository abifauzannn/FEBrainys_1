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

    if ($request->isMethod('post')) {
        // Form submission

        // Use the authentication token for API request
        $token = session()->get('access_token');

        // Generate a unique cache key based on the input data
        $cacheKey = 'syllabus_' . md5($request->input('name') . $request->input('subject') . $request->input('grade') . $request->input('notes'));

        // Check if the data is already in the cache
        if (Cache::has($cacheKey)) {
            $data = Cache::get($cacheKey);
        } else {
            $response = Http::withToken($token)
                ->timeout(60) // timeout dalam detik (contoh: 60 detik)
                ->post('https://be.brainys.oasys.id/api/syllabus/generate', [
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

                    // Store the data in the cache for 1 hour (adjust the time as needed)
                    Cache::put($cacheKey, $data, 60 * 60);
                } else {
                    // Handle the case where the expected structure is not present in the API response
                    dd($responseData);
                    return redirect('/generate')->with('error', 'Invalid API response format');
                }
            } else {
                // Handle error if needed
                dd($responseData);
                return redirect('/dashboard')->with('error', 'Failed to generate syllabus. Status code: ' . $statusCode);
            }
        }
    } else {
        // Initial form display
        $data = null;
    }

    // Pass the $data variable to the view
    return view('syllabus.generate', compact('data'));
}



}
