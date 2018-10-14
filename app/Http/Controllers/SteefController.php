<?php

namespace App\Http\Controllers;

use App\Http\Requests\SteefRequest;
use App\Steef;

class SteefController extends Controller
{
    public function index()
    {
        $steefs = Steef::latest()->get();

        return response()->json($steefs);
    }

    public function store(SteefRequest $request)
    {
        $steef = Steef::create($request->all());

        return response()->json($steef, 201);
    }

    public function show($id)
    {
        $steef = Steef::findOrFail($id);

        return response()->json($steef);
    }

    public function update(SteefRequest $request, $id)
    {
        $steef = Steef::findOrFail($id);
        $steef->update($request->all());

        return response()->json($steef, 200);
    }

    public function destroy($id)
    {
        Steef::destroy($id);

        return response()->json(null, 204);
    }
}