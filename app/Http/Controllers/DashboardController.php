<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalProducts = Product::count();

        $lowStockProducts = Product::where('quantity', '<', 5)->get();

        $query = StockMovement::with('product');

        if ($request->has('product_id') && $request->product_id != '') {
            $query->where('product_id', $request->product_id);
        }

        if ($request->has('start_date') ) {
            $query->where('created_at','LIKE',"%{$request->start_date}%" );
        }


        $stockMovements = $query->latest()->get();

        $products = Product::all();

        return view('dashboard', compact(
            'totalProducts', 
            'lowStockProducts', 
            'stockMovements', 
            'products'
        ));
    }
}
