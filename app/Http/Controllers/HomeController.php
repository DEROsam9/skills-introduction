<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Ensure you have the Post model imported

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   public function index()
    {
        // Fetch posts from the database
        $posts = Post::all(); // or Post::paginate(5);

        // Pass posts data to the dashboard view
        return view('auth.dashboard', compact('posts'));
    }
}
