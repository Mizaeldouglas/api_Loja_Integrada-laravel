<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Cupom;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function adicionarProdutoAoCarrinho(Request $request, $session_id)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart = Cart::firstOrCreate(['session_id' => $session_id]);

        $product = Product::findOrFail($product_id);
        $cart->products()->attach($product, ['quantity' => $quantity]);
        $response = [
            'Cart' => [
                'session_id' => $session_id,
                'quantity' => $quantity,
                'product_id' => $product_id,
                'cupom_id' => null
            ]
        ];

        return response()->json($response, 200);
    }

    public function buscarCarrinhoPorSessionId(Request $request, $session_id)
    {
        $sessionId = $session_id;
        $cart = Cart::where('session_id', $sessionId)->first();


        if (!$cart) {
            return response()->json(['error' => 'Carrinho não encontrado'], 404);
        }



        $response = [
            'Carts' => [
                [
                    'session_id' => $cart->session_id,
                    'original_value' => $cart->original_value,
                    'price' => $cart->price,
                    'total_quantity' => $cart->total_quantity,
                    'products' => []
                ]
            ]
        ];

        foreach ($cart->products as $product) {
            $response['Carts'][0]['products'][] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $product->pivot->quantity
            ];
        }

        return response()->json($response, 200);
    }

    public function adicionarCupomEProdutoAoCarrinho(Request $request, $session_id, $cupom)
    {
        $cupomValue = $request->query('tag');

        // Buscar o cupom pelo valor
        $cupom = Cupom::where('tag', $cupom)->first();

        if (!$cupom) {
            return response()->json(['error' => 'Cupom não encontrado'], 404);
        }

        $productData = $request->only(['product_id', 'quantity']);

        // Verifique se os dados do produto são válidos
        $validator = Validator::make($productData, [
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $cart = Cart::firstOrCreate(['session_id' => $session_id]);

        // Adicionar o cupom ao carrinho
        $cart->cupom_id = $cupom->id;
        $cart->save();

        // Adicionar o produto ao carrinho
        $cart->products()->attach($productData['product_id'], ['quantity' => $productData['quantity']]);

        return response()->json(['message' => 'Cupom e produto adicionados ao carrinho com sucesso'], 200);
    }


    public function index()
    {
        $carts = Cart::all();
        $formattedCarts = [];

        foreach ($carts as $cart) {
            $formattedCart = [
                'Cart' => [
                    'session_id' => $cart->session_id,
                    'original_value' => $cart->original_value,
                    'price' => $cart->price,
                    'total_quantity' => $cart->total_quantity,
                    'products' => []
                ]
            ];

            foreach ($cart->products as $product) {
                $formattedProduct = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $product->pivot->quantity
                ];
                $formattedCart['Cart']['products'][] = $formattedProduct;
            }
            $formattedCarts[] = $formattedCart;
        }

        return response()->json(['Carts' => $formattedCarts], 200);
    }

    public function deleterCupomEProdutoNoCarrinho(Request $request, $id, $session_id)
    {
        $cart = Cart::where('session_id', $session_id)->first();

        if (!$cart) {
            return response()->json(['Error' => 'Carrinho não encontrado!'], 404);
        }

        $cart->products()->detach();

        $cart->delete();

        Cart::where('session_id', $session_id)->delete();

        return response()->json(['Menssagem' => 'Excluido com Sucesso!!'], 200);
    }

    public function atualizarCupomEProdutoNoCarrinho($session_id, $id, Request $request)
    {

        $request->validate([
            'quantity' => 'required|min:1'
        ]);

        $cart = Cart::where('session_id', $session_id)->first();

        if (!$cart) {
            return response()->json(['Error' => 'Produto não encontrado no carrinho'], 404);
        }
        $product_id = $id;
        $new_quantity = $request->input('quantity');

        if (!$cart->products->contains($product_id)) {
            return response()->json(['Error' => 'Produto não encontrado no carrinho!'], 404);
        }

        $cart->products()->updateExistingPivot($product_id, ['quantity' => $new_quantity]);


        return response()->json(['Mensagem' => 'Atualizado com Sucesso!!'], 200);
    }
}