<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }


    public function store(Request $request)
    {
        $validation = $request->validate([
            'name'=>'string|required',
            'description' => 'string|required',
            'price' => 'numeric|required'
        ]);

        $product = Product::create($validation);

        return response()->json($product,201);
    }


    public function show(Request $product)
    {
        return response()->json($product,200);
    }


    public function update(Request $request, Product $product)
    {
         $validated = $request->validate([
        'name' => 'sometimes|max:255',
        'description' => 'sometimes',
        'price' => 'sometimes|numeric',
    ]);

        $product->update($validated);

        return response()->json($product, 200);
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return response('Deleted', 200);
    }

}