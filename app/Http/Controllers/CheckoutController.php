<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('menu')
                ->with('error', 'Cart kamu masih kosong.');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'total'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:30',
            'delivery_address' => 'required|string|max:1000',
        ]);


        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('menu')
                ->with('error', 'Cart kamu masih kosong.');
        }


        DB::beginTransaction();

        try {

            $total = 0;

            /*
             * Cek ulang stok dari database
             */
            foreach ($cart as $item) {

                $product = Product::find($item['id']);

                if (!$product) {
                    throw new \Exception(
                        'Produk ' . $item['name'] . ' sudah tidak tersedia.'
                    );
                }

                if ($product->stock < $item['quantity']) {
                    throw new \Exception(
                        'Stok ' . $product->name . ' tidak mencukupi.'
                    );
                }

                $total += $item['price'] * $item['quantity'];
            }


            /*
             * Buat nomor order
             */
            $orderNumber = 'CB-' . now()->format('YmdHis');


            /*
             * Buat Order
             */
            $order = Order::create([
                'user_id' => auth()->id(),

                'order_number' => $orderNumber,

                'customer_name' => $request->customer_name,

                'customer_email' => $request->customer_email,

                'customer_phone' => $request->customer_phone,

                'delivery_address' => $request->delivery_address,

                'total_amount' => $total,

                'status' => 'pending',
            ]);


            /*
             * Buat Order Items
             */
            foreach ($cart as $item) {

                $subtotal =
                    $item['price'] * $item['quantity'];

                OrderItem::create([
                    'order_id' => $order->id,

                    'product_id' => $item['id'],

                    'product_name' => $item['name'],

                    'price' => $item['price'],

                    'quantity' => $item['quantity'],

                    'subtotal' => $subtotal,
                ]);


                /*
                 * Kurangi stok produk
                 */
                Product::where('id', $item['id'])
                    ->decrement('stock', $item['quantity']);
            }


            /*
             * Commit transaksi
             */
            DB::commit();


            /*
             * Kosongkan cart
             */
            session()->forget('cart');


            return redirect()
                ->route('checkout.success', $order)
                ->with('success', 'Pesanan berhasil dibuat.');

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function success(Order $order)
    {
    return view('checkout-success', compact('order'));
    }
}