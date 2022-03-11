<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Blog::paginate(5);

        if ($request->ajax()) {
            return view('blog.index', compact('posts'));
        }

        return view('blog.index', compact('posts'));
    }
}
