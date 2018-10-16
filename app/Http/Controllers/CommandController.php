<?php

namespace App\Http\Controllers;
use Artisan;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    public function store(Request $request)
    {
       
        Artisan::call("crud:generator", ['name' =>$request->Name]);
        return $request->Name;
    }

}