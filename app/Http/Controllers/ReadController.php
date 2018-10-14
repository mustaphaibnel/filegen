<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReadRequest;
use App\Read;

class ReadController extends Controller
{
    public function index()
    {
        $reads = Read::latest()->get();

        return response()->json($reads);
    }

    public function store(ReadRequest $request)
    {
        $read = Read::create($request->all());

        return response()->json($read, 201);
    }

    public function show($id)
    {
        $read = Read::findOrFail($id);

        return response()->json($read);
    }

    public function update(ReadRequest $request, $id)
    {
        $read = Read::findOrFail($id);
        $read->update($request->all());

        return response()->json($read, 200);
    }

    public function destroy($id)
    {
        Read::destroy($id);

        return response()->json(null, 204);
    }
}