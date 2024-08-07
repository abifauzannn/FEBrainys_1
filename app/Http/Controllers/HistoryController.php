<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HistoryController extends Controller
{
    public function showHistory(Request $request)
{
    if (!session()->has('user')) {
        return redirect('/login');
    }

    $userData = session('user');
    $page = $request->get('page', 1);
    $type = $request->get('type', 'all'); // Default to 'all' if not provided

    // Fetch data without 'type' if it's 'all'
    $response = $this->fetchHistoryData($page, $type);

    if ($response) {
        $historyData = $response['data'];
        $pagination = $response['pagination'];
        $totalPages = $pagination['last_page'];
        $hasMorePages = $pagination['current_page'] < $totalPages;
    } else {
        $historyData = [];
        $pagination = null;
        $totalPages = 0;
        $hasMorePages = false;
    }

    // Define the pagination range
    $paginationRange = 4; // Number of pages per group
    $currentGroupStart = floor(($page - 1) / $paginationRange) * $paginationRange + 1;
    $currentGroupEnd = min($currentGroupStart + $paginationRange - 1, $totalPages);

    return view('histories.allHistories', compact('userData', 'historyData', 'page', 'hasMorePages', 'totalPages', 'type', 'currentGroupStart', 'currentGroupEnd'));
}
    public function fetchHistoryData($page, $type = 'all')
    {
        $token = session()->get('access_token');

        $queryParams = ['page' => $page];
        if ($type !== 'all') {
            $queryParams['type'] = $type;
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post(env('APP_API') . '/history', $queryParams);
        } else if ($type == 'all') {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get(env('APP_API') . '/history', $queryParams);
        }

        // dd($response);

        if ($response->successful()) {
            return $response->json();
        } else {
            // Handle the error
            return null;
        }
    }
}
