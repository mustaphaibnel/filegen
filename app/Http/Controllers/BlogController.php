<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();

        return response()->json($blogs);
    }

    public function store(BlogRequest $request)
    {
        $blog = Blog::create($request->all());

        return response()->json($blog, 201);
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        return response()->json($blog);
    }

    public function update(BlogRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->all());

        return response()->json($blog, 200);
    }

    public function destroy($id)
    {
        Blog::destroy($id);

        return response()->json(null, 204);
    }
}