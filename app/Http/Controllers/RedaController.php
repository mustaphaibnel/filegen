<?php

namespace App\Http\Controllers;

use App\Http\Requests\RedaRequest;
use App\Reda;

class RedaController extends Controller
{
    public function index()
    {
        $redas = Reda::latest()->get();

        return response()->json($redas);
    }

    public function store(RedaRequest $request)
    {
        $reda = Reda::create($request->all());

        return response()->json($reda, 201);
    }

    public function show($id)
    {
        $reda = Reda::findOrFail($id);

        return response()->json($reda);
    }

    public function update(RedaRequest $request, $id)
    {
        $reda = Reda::findOrFail($id);
        $reda->update($request->all());

        return response()->json($reda, 200);
    }

    public function destroy($id)
    {
        Reda::destroy($id);

        return response()->json(null, 204);
    }
}