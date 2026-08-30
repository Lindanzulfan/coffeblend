<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
    }


    public function add(Request $request, Product $product)
    {
        if ($product->stock <= 0) {
            return back()->with('error', 'Produk sedang habis.');
        }

        $quantity = max(1, (int) $request->input('quantity', 1));

        if ($quantity > $product->stock) {
            return back()->with(
                'error',
                'Jumlah yang dipilih melebihi stok.'
            );
        }

        $cart = session()->get('cart', []);

        $productId = $product->id;

        if (isset($cart[$productId])) {

            $newQuantity = $cart[$productId]['quantity'] + $quantity;

            if ($newQuantity > $product->stock) {
                return back()->with(
                    'error',
                    'Jumlah produk di cart melebihi stok.'
                );
            }

            $cart[$productId]['quantity'] = $newQuantity;

        } else {

            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'stock' => $product->stock,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', $product->name . ' berhasil ditambahkan ke cart.');
    }


    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back();
        }

        $quantity = max(1, (int) $request->quantity);

        if ($quantity > $cart[$id]['stock']) {
            return back()->with(
                'error',
                'Jumlah melebihi stok yang tersedia.'
            );
        }

        $cart[$id]['quantity'] = $quantity;

        session()->put('cart', $cart);

        return back()->with(
            'success',
            'Cart berhasil diperbarui.'
        );
    }


    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return back()->with(
            'success',
            'Produk berhasil dihapus dari cart.'
        );
    }


    public function clear()
    {
        session()->forget('cart');

        return back()->with(
            'success',
            'Cart berhasil dikosongkan.'
        );
    }
}