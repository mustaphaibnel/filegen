<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Artisan;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        
        return 'ok';
    }

    public function store(Request $request)
    {
       
        Artisan::call("crud:generator", ['name' =>$request->Name]);
        return $request->Name;
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return response()->json($post);
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return response()->json($post, 200);
    }

    public function destroy($id)
    {
        Post::destroy($id);

        return response()->json(null, 204);
    }
}