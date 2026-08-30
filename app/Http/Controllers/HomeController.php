<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        $featuredProducts = Product::with('category')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact(
            'categories',
            'featuredProducts'
        ));
    }
}