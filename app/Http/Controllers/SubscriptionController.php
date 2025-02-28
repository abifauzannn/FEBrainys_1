<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SubscriptionController extends Controller
{

    public function showHistory()
    {
        return view('langganan.tagihan.index');
    }


    public function showPaymentMethod()
    {
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            return view('payments.checkout-info', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }


    public function showTagihan()
    {
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            return view('langganan.tagihan.index', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }

    public function showPaket()
    {
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            return view('langganan.paket.index', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/dashboard');
        }
    }


    public function showCredit()
    {
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            return view('langganan.extraCredit.index', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }

    public function showPaymentProcess()
    {
        if (session()->has('user')) {
            // Ambil data pengguna dari sesi
            $userData = session('user');

            return view('payments.proses-pembayaran', compact('userData'));
        } else {
            // Redirect ke halaman login jika kunci 'user' tidak ada dalam sesi
            return redirect('/login');
        }
    }
    public function getExtraCredit()
    {

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

    public function getAnnualPackages()
{
    $response = Http::withToken(session()->get('access_token'))
        ->get('https://testing.brainys.oasys.id/api/subscription/package');

    if ($response->successful()) {
        $data = $response->json();
        $annualPackages = $data['data']['annually'];

        return view('langganan.paket.tahunan', compact('annualPackages')); // Ganti 'your-view-file' dengan nama file blade yang sesuai
    }

    return view('langganan.paket.tahunan')->with('annualPackages', []);
}


    public function getMonthlyPackages()
    {
        $response = Http::withToken(session()->get('access_token'))
            ->get('https://testing.brainys.oasys.id/api/subscription/package');

        if ($response->successful()) {
            $data = $response->json();
            $monthlyPackages = $data['data']['monthly'];

            return view('langganan.paket.bulanan', compact('monthlyPackages')); // Ganti 'your-view-file' dengan nama file blade Anda
        }

        return view('langganan.paket.bulanan')->with('monthlyPackages', []);
    }





    public function getInfo(Request $request)
    {
        $item_id = $request->input('item_id');
        $item_type = $request->input('item_type');

        $response = Http::withToken(session()->get('access_token'))
            ->post(env('APP_API') . '/checkout/get-info', [
                'item_id' => $item_id,
                'item_type' => $item_type
            ]);

        if ($response->successful()) {
            $data = $response->json()['data'];
            return view('payments.checkout-info', compact('data', 'item_id', 'item_type')); // Replace 'your-view-name' with your actual view name
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
        ->post(env('APP_API') . '/checkout/place-order-v2', [
            'item_id' => $item_id,
            'item_type' => $item_type,
        ]);

    // Decode response JSON
    $responseData = $response->json();

    // Check if the request was successful
    if ($response->successful()) {
        $data = $responseData['data'];
        $linkPayment = $data['transaction_payment']['checkout_url'];

        return redirect()->away($linkPayment);
    } else {
        // Jika error, ambil transaction_code dari data response
        if (isset($responseData['data']['transaction_code'])) {
            $transactionCode = $responseData['data']['transaction_code'];
            return redirect()->route('order.detail', ['transaction_code' => $transactionCode]);
        }

        // Jika tidak ada transaction_code, tampilkan error
        return back()->with('error', $responseData['message']);
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
                $packageResponse = $this->getPackages();

                if (isset($packageResponse['data']['package'])) {
                    // Replace the old package with the new one
                    $newPackage = $packageResponse['data']['package'];

                    // Save the new package to session
                    session()->put('package', $newPackage);
                }
            }

            // Pass the data to the view
            $responeData = $response['data'];
            $linkPayment = $responeData['transaction_payment']['checkout_url'];

            return view('payments.proses-pembayaran', compact('data', 'linkPayment'));
        } else {
            return redirect()->route('langganan.tagihan')->with('error', 'Failed to retrieve history data.');
        }
    }

    public function getPackages()
{
    $response = Http::withToken(session()->get('access_token'))
        ->get('https://testing.brainys.oasys.id/api/user-profile');

    if ($response->successful()) {
        $responseData = $response->json();

        // Pastikan ada data 'package' dan ambil 'package_name'
        if (isset($responseData['data']['package'][0]['package_name'])) {
            $packageName = $responseData['data']['package'][0]['package_name'];


            // Update session dengan package_name yang baru
            session()->put('package_name', $packageName);
            session()->save();  // Pastikan sesi disimpan
        }

        return $response;// Menampilkan semua data session
    } else {
        dd($response->body());  // Menampilkan respons error dari API
    }
}


    public function getCancelPackages()
    {
        $response = Http::withToken(session()->get('access_token'))
            ->get('https://testing.brainys.oasys.id/api/subscription/package/cancel');

        if ($response->successful()) {

            return back();
        } else {
            dd($response);
        }
    }



    public function fetchHistoryDataAjax(Request $request)
    {
        $page = $request->get('page', 1);
        $token = session()->get('access_token');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get(env('APP_API') . '/subscription/history', ['page' => $page]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'Gagal mengambil data'], 500);
        }
    }



    public function exportInvoice(Request $request)
    {
        // Ambil generate_id dari permintaan
        $generateId = $request->input('generateId');

        // Buat permintaan HTTP ke API untuk mengunduh dokumen Word
        $response = Http::withToken(session()->get('access_token'))
            ->post(env('APP_API') . '/subscription/invoice', [
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
