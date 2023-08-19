<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
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


    public function show($id)
    {
        // Fetch the product using the $id
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product, 200);
    }


    public function update(Request $request, Product $product)
    {
         $validated = $request->validate([
        'name' => 'required|max:255',
        'description' => 'required',
        'price' => 'numeric',
    ]);



    if($product){
        
        $product->update($validated);
        return response()->json($product, 200);
    }else{
        return response()->json(['message' => 'Product not found'], 404);
    }

    }


    public function destroy(Product $product)
    {
        if($product){
            $product->delete();
            return response('Deleted', 204);
        }else{
            return response()->json(['message' => 'Product not found'], 404);
        }


    }

}