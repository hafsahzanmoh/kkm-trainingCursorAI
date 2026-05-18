<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();

        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->save();

        return redirect()->route('blogs.index');
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(Blog $blog, Request $request)
    {
        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->save();

        return redirect()->route('blogs.index');
    }

    public function delete(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index');
    }
}
