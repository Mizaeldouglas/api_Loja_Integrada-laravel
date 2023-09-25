<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return response()->json(['Products' => $products], 200);
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' => 'required',
                'price' => 'required',
                'stock' => 'required'
            ]);

            $product = Product::create($validate);

            return response()->json($product, 201);
        } catch (Exception $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

    public function show(string $id)
    {
        $products = Product::find($id);

        return response()->json(['Products' => $products], 200);
    }

    public function update(Request $request, string $id)
    {
        $products = Product::find($id);
        $products->update($request->all());
        $products->save();
        return response()->json(['Products' => $products], 200);
    }

    public function destroy(string $id)
    {
        $products = Product::find($id);
        $products->delete();
        return response()->json("Produto deletado Com sucesso!", 204);
    }
}
