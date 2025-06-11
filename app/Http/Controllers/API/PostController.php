<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // GET /api/posts
    public function index(Request $request)
    {
        $posts = Post::paginate(5);

        return response()->json([
            'status' => 1,
            'message' => 'Posts retrieved successfully',
            'data' => $posts
        ]);
    }

    // POST /api/posts
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post = Post::create([
            'user_id'=> Auth::id(), // 🔐 Automatically set the authenticated user ID
            'title' => $validated['title'],
            'body' => $validated['body'],
        ]);

        
            return response()->json([
                'status' => 1,
                'message' => 'Post created successfully',
                'data' => $post,
            ], 201);
        

        return redirect()->route('dashboard')->with('success', 'Post created successfully');

    } 

    // GET /api/posts/{id}
    public function show(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        return response()->json([
            'status' => 1,
            'message' => 'Post retrieved successfully',
            'data' => $post
        ]);
    }




    // PUT/PATCH /api/posts/{id}
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('update', $post); // 🔐 Check ownership

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $post->update($validated);

        return response()->json([
            'status' => 1,
            'message' => 'Post updated successfully',
            'data' => $post
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('delete', $post); // 🔐 Check ownership

        $post->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Post deleted successfully',
        ]);
    }

    public function myPosts()
    {
        $user = Auth::user(); // logged-in user

        // Get user's posts with comments (and comment authors)
        $posts = Post::with(['comments.user']) // eager load comments and comment authors
                    ->where('user_id', $user->id)
                    ->latest()
                    ->get();

        return response()->json($posts);
    }

    // 2️⃣ Other Users' Posts + Comments
    public function otherPosts()
    {
        $user = Auth::user();

        // All posts except mine, with comments and authors
        $posts = Post::with(['user', 'comments.user'])
                    ->where('user_id', '!=', $user->id)
                    ->latest()
                    ->get();

        return response()->json($posts);
    }
}


  
    

