<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class ChekoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        
        return view('cekot.index', ['costs' => '']);
    }

    public function checkout(Request $request)
{
    // Ambil ID item dari request
    $itemIds = json_decode($request->selected_items, true);

    // Ambil data item dan relasi produknya
    $items = Cart::with('product')->whereIn('id', $itemIds)->get();

    // Hitung total harga semua item
    $total = $items->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    // Ambil daftar provinsi dari API RajaOngkir
    $provincesResponse = Http::withHeaders([
        'key' => '316e4f0570ad8482913c3cd334873531'
    ])->get('https://api.rajaongkir.com/starter/province');

    $provincesData = $provincesResponse->json();
    $provinces = $provincesData['rajaongkir']['results'];

    // Ambil ID provinsi dari request jika tersedia
    $provinceId = $request->province_id;

    $response = Http::withHeaders([
        'key' => '316e4f0570ad8482913c3cd334873531'
    ])->get('https://api.rajaongkir.com/starter/city');

    $cities = $response['rajaongkir']['results'];

    $bogorCity = collect($cities)->firstWhere('city_name', 'Bogor');
    $cost = null;



    // Kirim data ke view
    return view('cekot.index', ['cities' => $cities, 'cost' => $cost, 'costs' => ''], compact('items', 'total', 'provinces', 'bogorCity'));
}

public function getCities($provinceId)
{
    $citiesResponse = Http::withHeaders([
        'key' => '316e4f0570ad8482913c3cd334873531'
    ])->get("https://api.rajaongkir.com/starter/city?province=$provinceId");

    $citiesData = $citiesResponse->json();

    return response()->json($citiesData['rajaongkir']['results']);
}

// public function checkCost(Request $request) 
// {
//     $itemIds = json_decode($request->selected_items, true);
//     $items = Cart::with('product')->whereIn('id', $itemIds)->get();

//     $total = $items->sum(fn($item) =>  $item->product->price * $item->quantity);

//     // Ambil data provinsi
//     $provinces = Http::withHeaders([
//         'key' => '316e4f0570ad8482913c3cd334873531'
//     ])->get('https://api.rajaongkir.com/starter/province')
//       ->json()['rajaongkir']['results'];

//     // Ambil data kota berdasarkan provinsi yang dipilih
//     $provinceId = $request->province_id;
//     $cities = [];

//     if ($provinceId) {
//         $cities = Http::withHeaders([
//             'key' => '316e4f0570ad8482913c3cd334873531'
//         ])->get("https://api.rajaongkir.com/starter/city?province={$provinceId}")
//           ->json()['rajaongkir']['results'];
//     }

//     // Cek ongkos kirim jika data lengkap tersedia
//     // $shippingCosts = [];
//     // if ($request->origin && $request->destination && $request->weight && $request->courier) {
//     //     $costResponse = Http::withHeaders([
//     //         'key' => '316e4f0570ad8482913c3cd334873531',
//     //     ])->post("https://api.rajaongkir.com/starter/cost", [
//     //         'origin' => $request->origin,
//     //         'destination' => $request->destination,
//     //         'weight' => $request->weight,
//     //         'courier' => $request->courier
//     //     ]);

//     //     $shippingCosts = $costResponse->json()['rajaongkir']['results'][0]['costs'] ?? [];
//     // }

//     return view('cekot.index', compact('items', 'total', 'provinces', 'cities', 'shippingCosts'));
// }

public function checkShippingCost(Request $request)
{

    // Ambil ID item dari request
    $itemIds = json_decode($request->selected_items, true);

    // Ambil data item dan relasi produknya
    $items = Cart::with('product')->whereIn('id', $itemIds)->get();

    // Hitung total harga semua item
    $total = $items->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    $responseCity = Http::withHeaders([
        'key' => '316e4f0570ad8482913c3cd334873531',
        'content-type' => 'application/x-www-form-urlencoded',
    ])->get('https://api.rajaongkir.com/starter/city');

    $responseCost = Http::withHeaders([
        'key' => '316e4f0570ad8482913c3cd334873531',
    ])->asForm()->post('https://api.rajaongkir.com/starter/cost', [
        'origin' => $request->origin,
        'destination' => $request->destination,
        'weight' => $request->weight,
        'courier' => $request->courier
    ]);


    // Ambil ulang endpoint untuk data provinsi dan kota
    // Ambil daftar provinsi dari API RajaOngkir
    $provincesResponse = Http::withHeaders([
        'key' => '316e4f0570ad8482913c3cd334873531'
    ])->get('https://api.rajaongkir.com/starter/province');

    $provincesData = $provincesResponse->json();
    $provinces = $provincesData['rajaongkir']['results'];

    // Ambil ID provinsi dari request jika tersedia
    $provinceId = $request->province_id;

    $response = Http::withHeaders([
        'key' => '316e4f0570ad8482913c3cd334873531'
    ])->get('https://api.rajaongkir.com/starter/city');

    $cities = $response['rajaongkir']['results'];

    $bogorCity = collect($cities)->firstWhere('city_name', 'Bogor');

    // Ambil data kota dan biaya
    $cities = $responseCity->json()['rajaongkir']['results'] ?? [];
    $costs = $responseCost->json()['rajaongkir']['results'] ?? [];

    // Jika gagal ambil biaya
    // if (!$responseCost->successful() || empty($costs)) {
    //     return response()->json(['error' => 'Tidak ada biaya pengiriman yang tersedia'], 404);
    // }

    // Return dua-duanya
    // return response()->json([
    //     'cities' => $cities,
    //     'shipping_costs' => $costs
    // ]);
    // dd($request->all());


    return view('cekot.index', ['cities' => $cities, 'costs' => $costs], compact('items', 'total', 'bogorCity', 'provinces'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'courier' => 'required|string',
            'service' => 'required|string',
            'weight' => 'required|integer',
            'total_price' => 'required|numeric',
            'masukan' => 'nullable|string',
            'alamat' => 'required|string',
        ]);
    
        // Simpan order
        $order = Order::create([
            'user_id' => Auth::id(),
            'origin' => $request->origin,
            'destination' => $request->destination,
            'courier' => $request->courier,
            'service' => $request->service,
            'weight' => $request->weight,
            'total_price' => $request->total_price,
            'masukan' => $request->masukan,
            'alamat' => $request->alamat,
            'status' => 'Pending'
        ]);
    
        return redirect()->route('orders.show', $order->id)->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
