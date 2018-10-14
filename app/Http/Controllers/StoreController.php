<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Store;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::latest()->get();

        return response()->json($stores);
    }

    public function store(StoreRequest $request)
    {
        $store = Store::create($request->all());

        return response()->json($store, 201);
    }

    public function show($id)
    {
        $store = Store::findOrFail($id);

        return response()->json($store);
    }

    public function update(StoreRequest $request, $id)
    {
        $store = Store::findOrFail($id);
        $store->update($request->all());

        return response()->json($store, 200);
    }

    public function destroy($id)
    {
        Store::destroy($id);

        return response()->json(null, 204);
    }
}