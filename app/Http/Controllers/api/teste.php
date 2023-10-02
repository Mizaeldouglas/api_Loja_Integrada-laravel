<?php

// namespace App\Http\Controllers\api;

// use App\Http\Controllers\Controller;
// use App\Models\Cart;
// use App\Models\Cupom;
// use App\Models\Product;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;

// class CartController extends Controller
// {
//     public function deleterCupomEProdutoNoCarrinho(Request $request, $session_id, $id)
//     {
//         // Primeiro, exclua os produtos associados ao carrinho
//         $cart = Cart::where('session_id', $session_id)->first();

//         if (!$cart) {
//             return response()->json(['error' => 'Carrinho não encontrado'], 404);
//         }

//         $cart->products()->detach();

//         // Em seguida, exclua o carrinho em si
//         $cart->delete();

//         // Por fim, exclua a sessão
//         Cart::where('session_id', $session_id)->delete();

//         return response()->json(['Mensagem' => 'Excluído com sucesso!!'], 200);
//     }
// }