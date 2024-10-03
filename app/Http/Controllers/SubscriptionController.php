<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SubscriptionController extends Controller
{

    public function success(){
        return view('payments.callback.success');
    }
public function showPaymentMethod(){
    if (session()->has('user')) {
        // Ambil data pengguna dari sesi
        $userData = session('user');

        return view('payments.checkout-info', compact('userData'));
    } else {
        // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
        return redirect('/login');
    }
}


    public function showTagihan(){
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            return view('langganan.tagihan.index', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }

    public function showPaket(){
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            return view('langganan.paket.index', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }

    public function showCredit(){
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            return view('langganan.extraCredit.index', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }

    public function showPaymentProcess(){
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            return view('payments.proses-pembayaran', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }
    public function getExtraCredit(){

        $response = Http::withToken(session()->get('access_token'))
        ->get('https://testing.brainys.oasys.id/api/subscription/extra-credit');

        // Periksa apakah permintaan HTTP sukses
        if ($response->successful()) {
        // Mengembalikan data status pengguna
        return $response->json()['data'];
        } else {
        // Tangani kasus jika permintaan HTTP gagal
        return redirect()->back()->with('error', 'Failed to retrieve packages.');
        }

    }

    public function getPackages()
    {
        $response = Http::withToken(session()->get('access_token'))
            ->get('https://testing.brainys.oasys.id/api/subscription/package');

        if ($response->successful()) {
            return $response->json(); // Return the entire JSON response
        } else {
            // Handle error
            return ['data' => ['monthly' => []]]; // Return empty array if there's an error
        }
    }


    public function getInfo(Request $request)
{
    $item_id = $request->input('item_id');
    $item_type = $request->input('item_type');

    $response = Http::withToken(session()->get('access_token'))
                    ->post(env('APP_API').'/checkout/get-info', [
                        'item_id' => $item_id,
                        'item_type' => $item_type
                    ]);

    if ($response->successful()) {
        $data = $response->json()['data'];
        return view('payments.checkout-info', compact('data', 'item_id' , 'item_type')); // Replace 'your-view-name' with your actual view name
    } else {
        return back()->with('error', 'Failed to retrieve item info.');
    }
}

public function getOrder(Request $request)
{
    $item_id = $request->input('item_id');
    $item_type = $request->input('item_type');
    $paymentMethodCode = $request->input('paymentMethodCode');

    // Send POST request to place an order
    $response = Http::withToken(session()->get('access_token'))
                    ->post(env('APP_API').'/checkout/place-order', [
                        'item_id' => $item_id,
                        'item_type' => $item_type,
                        'payment_method_id' => $paymentMethodCode
                    ]);

    // Check if the request was successful
    if ($response->successful()) {
        $data = $response->json()['data'];
        $transactionCode = $data['transaction']['transaction_code'];

        // Redirect to internal route with the transaction code
        return redirect()->route('order.detail', ['transaction_code' => $transactionCode]);
    } else {
        return back()->with('error', 'Failed to retrieve item info.');
    }
}




// app/Http/Controllers/HistoryController.php

public function showDetailOrder($transaction_code)
{
    $historyUrl = "https://testing.brainys.oasys.id/api/subscription/history/{$transaction_code}";

    // Fetch data from the detail history endpoint
    $response = Http::withToken(session()->get('access_token'))->get($historyUrl);

    if ($response->successful()) {
        $data = $response->json()['data'];

        // Check the status of the transaction
        $status = $data['transaction']['status'];

        if ($status === 'completed') {
            // If status is completed, get the latest package info
            $packageResponse = $this->getInfoPackages();

            if (isset($packageResponse['data']['package'])) {
                // Replace the old package with the new one
                $newPackage = $packageResponse['data']['package'];

                // Save the new package to session
                session()->put('package', $newPackage);
            }
        } elseif ($status === 'pending') {
            // If the status is still pending, refresh the page after 5 seconds
            header("Refresh: 5");
        }

        // Pass the data to the view
        return view('payments.proses-pembayaran', compact('data'));

    } else {
        return redirect()->route('checkout.place-order')->with('error', 'Failed to retrieve history data.');
    }
}

    public function getInfoPackages()
    {
        $response = Http::withToken(session()->get('access_token'))
            ->get('https://testing.brainys.oasys.id/api/user-profile');

        if ($response->successful()) {
            return $response->json(); // Return the entire JSON response
        } else {
            // Handle error
            return back()->with('error', 'Failed to retrieve packages.'); // Return empty array if there's an error
        }
    }


    public function fetchHistoryData($page)
    {
        $token = session()->get('access_token');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get(env('APP_API') . '/subscription/history', ['page' => $page]);

        if ($response->successful()) {
            return $response->json();
        } else {
            // Handle the error
            return null;
        }
    }

    public function showHistory(Request $request)
    {

        $userData = session('user');
        $page = $request->get('page', 1);

        // Fetch data without 'type' if it's 'all'
        $response = $this->fetchHistoryData($page);

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

        return view('langganan.tagihan.index', compact('userData', 'historyData', 'page', 'hasMorePages', 'totalPages',  'currentGroupStart', 'currentGroupEnd'));
    }



public function exportInvoice(Request $request)
{
    // Ambil generate_id dari permintaan
    $generateId = $request->input('generateId');

    // Buat permintaan HTTP ke API untuk mengunduh dokumen Word
    $response = Http::withToken(session()->get('access_token'))
                    ->post(env('APP_API').'/subscription/invoice', [
                        'id' => $generateId
                    ]);

    // Periksa apakah permintaan berhasil
    if ($response->successful()) {
        // Ambil URL unduhan dari respons
        $downloadUrl = $response->json()['data']['download_url'];

        // Arahkan pengguna ke URL unduhan
        return redirect($downloadUrl);
    } else {

        return null;
    }
}









}
