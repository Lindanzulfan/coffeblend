<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        $productsQuery = Product::with('category')
            ->latest();

        if ($request->filled('category')) {
            $productsQuery->where('category_id', $request->category);
        }

        $products = $productsQuery->paginate(12)->withQueryString();

        return view('menu', compact(
            'categories',
            'products'
        ));
    }
    public function show(Product $product)
    {
        $product->load('category');

    return view('product-detail', compact('product'));
    }   
}