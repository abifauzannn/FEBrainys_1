<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SimulasiController extends Controller
{
    public function simulasi()
    {
        if (session()->has('user')) {
            $userData = session('user');
            return view('generates.generate-simulasi', compact('userData'));
        } else {
            return redirect('/login');
        }
    }

    public function generateSimulasi(Request $request)
    {
        if (!session()->has('access_token') || !session()->has('user')) {
            return redirect('/login')->with('error', 'Please log in to generate simulation.');
        }

        $generateId = null;
        $responseMessage = null;

        if ($request->isMethod('post')) {
            $token = session()->get('access_token');

            $response = Http::withToken($token)
                ->timeout(60)
                ->post(env('APP_API') . '/simulation/generate', [
                    'name'       => $request->input('name'),
                    'game_scheme' => $request->input('skema'),
                    'grade'      => $request->input('grade'),
                    'subject'    => $request->input('subject'),
                    'material'   => $request->input('material'),
                    'notes'      => $request->input('notes')
                ]);

            $statusCode = $response->status();
            $responseData = $response->json();

            if ($response->successful()) {
                if (isset($responseData['data'])) {
                    $data = $responseData['data'];
                    $generateId = $responseData['data']['id'];
                    $responseMessage = 'Simulation generated successfully!';
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
                    session()->flash('error', 'Failed to generate simulation. Status code: ' . $statusCode);
                }
            }

            return redirect('/generate-simulasi');
        } else {
            $data = null;
        }

        return view('outputGenerates.outputSimulasi', compact('data', 'generateId'));
    }

    public function exportToWord(Request $request)
    {
        $generateId = $request->input('generate_id');

        $response = Http::withToken(session()->get('access_token'))
            ->post(env('APP_API') . '/simulation/export-word', [
                'id' => $generateId
            ]);

        if ($response->successful()) {
            $downloadUrl = $response->json()['data']['download_url'];
            return redirect($downloadUrl);
        } else {
            return back()->with('error', 'Failed to export to Word.');
        }
    }

    public function exportToPpt(Request $request)
    {
        $generateId = $request->input('generate_id');

        $response = Http::withToken(session()->get('access_token'))
            ->post(env('APP_API') . '/simulation/export-ppt', [
                'id' => $generateId
            ]);

        if ($response->successful()) {
            $downloadUrl = $response->json()['data']['download_url'];
            return redirect($downloadUrl);
        } else {
            return back()->with('error', 'Failed to export to PPT.');
        }
    }

    public function getDetailSimulasi($idSimulasi)
    {
        if (!session()->has('access_token') || !session()->has('user')) {
            return redirect('/login')->with('error', 'Please log in to fetch simulation history.');
        }

        $token = session()->get('access_token');

        $response = Http::withToken($token)
            ->timeout(60)
            ->get(env('APP_API') . '/simulation/history/' . $idSimulasi);

        $statusCode = $response->status();
        $responseData = $response->json();

        if ($response->successful()) {
            if (isset($responseData['data']['output_data'])) {
                $simulasiHistory = $responseData['data'];
                return view('detailHistory.simulasi', compact('simulasiHistory'));
            } else {
                return redirect('/history')->with('error', $responseData['message']);
            }
        } else {
            if (isset($responseData['status']) && $responseData['status'] === 'failed' && isset($responseData['message'])) {
                return redirect('/history')->with('error', $responseData['message']);
            } else {
                return redirect('/history')->with('error', 'Failed to fetch simulation history.');
            }
        }
    }

    public function getCreditCharges()
    {
        $response = Http::withToken(session()->get('access_token'))
            ->get(env('APP_API') . '/module-credit-charges/simulasi');

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
