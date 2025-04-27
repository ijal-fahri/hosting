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
        try {
            // Get selected cart items
            $itemIds = json_decode($request->selected_items);
            $items = Cart::with('product')->whereIn('id', $itemIds)->get();

            // Calculate subtotal from cart items
            $subtotal = $items->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            // Get cities from RajaOngkir
            $response = Http::withHeaders([
                'key' => '316e4f0570ad8482913c3cd334873531'
            ])->get('https://api.rajaongkir.com/starter/city');

            if (!$response->successful()) {
                throw new \Exception('Gagal mengambil data kota');
            }

            $citiesData = $response->json();
            $cities = $citiesData['rajaongkir']['results'] ?? [];

            return view('cekot.index', compact('items', 'subtotal', 'cities'));

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function getCities($provinceId)
    {
        $citiesResponse = Http::withHeaders([
            'key' => '316e4f0570ad8482913c3cd334873531'
        ])->get("https://api.rajaongkir.com/starter/city?province=$provinceId");

        $citiesData = $citiesResponse->json();

        return response()->json($citiesData['rajaongkir']['results']);
    }

    public function checkShippingCost(Request $request)
    {
        try {
            $request->validate([
                'origin' => 'required',
                'destination' => 'required',
                'weight' => 'required|numeric',
                'courier' => 'required|in:jne,pos,tiki'
            ]);

            $response = Http::withHeaders([
                'key' => '316e4f0570ad8482913c3cd334873531'
            ])->asForm()->post('https://api.rajaongkir.com/starter/cost', [
                        'origin' => $request->origin,
                        'destination' => $request->destination,
                        'weight' => $request->weight,
                        'courier' => $request->courier
                    ]);

            if (!$response->successful()) {
                throw new \Exception('Gagal mendapatkan data ongkir');
            }

            $result = $response->json();

            return response()->json([
                'status' => 'success',
                'data' => $result['rajaongkir']['results'][0]['costs']
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
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
        try {
            // Validasi input
            $request->validate([
                'service' => 'required|string',
                'alamat' => 'required|string',
                'masukan' => 'nullable|string',
                'pay' => 'required|in:cod,midtrans',
                'selected_items' => 'required'
            ]);

            // Ambil items dari cart
            $itemIds = json_decode($request->selected_items, true);
            $cartItems = Cart::with('product')->whereIn('id', $itemIds)->get();

            // Hitung total
            $subtotal = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            // Buat order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $subtotal,
                'shipping_cost' => $request->shipping_cost,
                'payment_method' => $request->pay,
                'service' => $request->service,
                'status' => 'pending',
                'masukan' => $request->masukan,
                'alamat' => $request->alamat
            ]);

            // Pindahkan items dari cart ke order_items
            foreach ($cartItems as $item) {
                $order->orderItems()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);

                // Hapus item dari cart
                $item->delete();
            }

            // Redirect sesuai metode pembayaran
            if ($request->pay === 'midtrans') {
                // Redirect ke halaman pembayaran Midtrans
                return redirect()->route('payment.midtrans', $order->id);
            } else {
                // COD - redirect ke halaman sukses
                return redirect()
                    ->route('orders.success', $order->id)
                    ->with('success', 'Pesanan berhasil dibuat!');
            }

        } catch (\Exception $e) {
            \Log::error('Order creation error: ' . $e->getMessage());
            return back()
                ->with('error', 'Gagal membuat pesanan: ' . $e->getMessage())
                ->withInput();
        }
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
