<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (\request('search')) {
            $posts =  Articles::latest()->where('title', 'like', '%' . \request('search') . '%')->orWhere('content', 'like', '%' . \request('search') . '%')->paginate(7);
        } else {
            $posts = Articles::latest()->paginate(7);
        }

        return view('home', [
            'title' => 'Home',
            'posts' => $posts

        ]);
    }

    public function detail($slug)
    {
        $posts = Articles::where('slug', $slug)->get();

        return view('detail', [
            'title' => 'Detail Post',
            'posts' => $posts
        ]);
    }

    public function about()
    {
        return \view('about', [
            'title' => "About"
        ]);
    }
}
