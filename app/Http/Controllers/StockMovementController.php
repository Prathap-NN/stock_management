<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    public function index(Request $request)
    {
        $query = StockMovement::with('product');

        if ($request->has('product_id') && $request->product_id != '') {
            $query->where('product_id', $request->product_id);
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $movements = $query->latest()->get();

        $products = Product::all();

        return view('stock_movements.index', compact('movements', 'products'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stock_movements.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id',
            'type' => 'required|in:IN,OUT',
            'quantity' => 'required|integer|min:1',
            'remarks' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);
        if ($request->type == 'OUT' && $product->quantity < $request->quantity) {
            return back()->withErrors(['error' => 'Not enough stock available.']);
        }

        StockMovement::create($request->all());

        $product->update([
            'quantity' => $request->type == 'IN' ? $product->quantity + $request->quantity : $product->quantity - $request->quantity
        ]);

        return redirect()->route('stock_movements.index')->with('success', 'Stock movement recorded.');
    }

    public function edit(StockMovement $stockMovement)
    {
        $products = Product::all();
        return view('stock_movements.edit', compact('products','stockMovement'));
    }

    public function update(Request $request, StockMovement $stockMovement)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:IN,OUT',
            'quantity' => 'required|integer|min:1',
            'remarks' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->type == 'OUT' && $product->quantity < $request->quantity) {
            return back()->withErrors(['error' => 'Not enough stock available.']);
        }

        $stockMovement->update($request->all());

        if ($request->type == 'IN') {
            $product->update(['quantity' => $product->quantity + $request->quantity]);
        } else {
            $product->update(['quantity' => $product->quantity - $request->quantity]);
        }

        return redirect()->route('stock_movements.index')->with('success', 'Stock movement updated successfully.');
    }

    public function destroy(StockMovement $stockMovement)
    {
        $product = $stockMovement->product;

        if ($stockMovement->type == 'IN') {
            $product->update(['quantity' => $product->quantity - $stockMovement->quantity]);
        } else {
            $product->update(['quantity' => $product->quantity + $stockMovement->quantity]);
        }

        $stockMovement->delete();

        return redirect()->route('stock_movements.index')->with('success', 'Stock movement deleted successfully.');
    }

    // Api

    public function getAllStockMovements()
{
    return response()->json(StockMovement::with('product')->get(), 200);
}

public function getStockMovementById($id)
{
    $movement = StockMovement::with('product')->find($id);
    return $movement 
        ? response()->json($movement, 200) 
        : response()->json(['message' => 'Stock Movement not found'], 404);
}

public function createStockMovement(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'type' => 'required|in:in,out',
        'quantity' => 'required|integer|min:1',
        'remarks' => 'nullable|string',
    ]);

    $movement = StockMovement::create($request->all());
    return response()->json($movement, 201);
}

}
