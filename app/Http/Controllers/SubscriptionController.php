<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SubscriptionController extends Controller
{

public function showCheckoutInfo(){
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

    $response = Http::withToken(session()->get('access_token'))
                    ->post(env('APP_API').'/checkout/place-order', [
                        'item_id' => $item_id,
                        'item_type' => $item_type,
                        'payment_method_id' => $paymentMethodCode
                    ]);

    if ($response->successful()) {
       $data = $response->json()['data'];
       return view('payments.proses-pembayaran', compact('data'));
    } else {
        return back()->with('error', 'Failed to retrieve item info.');
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





}
