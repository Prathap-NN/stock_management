<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function index()
    {
        {
            $products = Product::all();
            return view('products.index', compact('products'));
        }
    }

   
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sku' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);
        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product created successfully');

    }

    
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:product,sku,' . $product->id,
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }


    // api functions

    public function getAllProducts()
{
    return response()->json(Product::all(), 200);
}

public function getProductById($id)
{
    $product = Product::find($id); // Find product by ID
    
    if ($product) {
        return response()->json($product, 200); // If product found, return it
    } else {
        return response()->json(['message' => 'Product not found'], 404); // If not found, return error
    }
}


public function createProduct(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'quantity' => 'required|integer|min:0',
    ]);

    $product = Product::create($request->all());
    return response()->json($product, 201);
}

public function updateProduct(Request $request, $id)
{
    $product = Product::find($id);
    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $product->update($request->all());
    return response()->json($product, 200);
}

public function deleteProduct($id)
{
    $product = Product::find($id);
    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    $product->delete();
    return response()->json(['message' => 'Product deleted'], 200);
}

}
