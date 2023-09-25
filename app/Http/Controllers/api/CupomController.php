<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cupom;
use Illuminate\Http\Request;

class CupomController extends Controller
{
    public function index()
    {
        $cupom = Cupom::all();

        return response()->json(['Cupons' => $cupom], 200);
    }


    public function store(Request $request)
    {
        $cupom = Cupom::create($request->all());

        return response()->json($cupom, 201);
    }

    public function show(string $id)
    {
        $cupom = Cupom::find($id);
        if (is_null($cupom)) {
            return response()->json(["errors" => 'Cupom não encontrado'], 404);
        }

        return response()->json(['Cupons' => $cupom], 200);
    }


    public function update(Request $request, string $id)
    {
        $cupom = Cupom::find($id);
        $cupom->update($request->all());
        $cupom->save();
        return response()->json(['Cupons' => $cupom], 200);
    }

    public function destroy(string $id)
    {
        $cupom = Cupom::find($id);
        if (is_null($cupom)) {
            return response()->json(["errors" => 'Cupom não encontrado'], 404);
        }
        $cupom->delete();
        return response()->json('Deletado Com sucesso!!', 204);
    }
}
