<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $post = Post::findOrFail($postId);

        $comment = new Comment([
            'body' => $request->body,
            'user_id' => Auth::id(),
        ]);

        $post->comments()->save($comment);

        return response()->json([
            'status' => 1,
            'message' => 'Comment added successfully',
            'data' => $comment
        ]);
    }

    public function index($postId)
    {
        $post = Post::findOrFail($postId);
        $comments = $post->comments()->with('user')->latest()->get();

        return response()->json([
            'status' => 1,
            'message' => 'Comments retrieved successfully',
            'data' => $comments
        ]);
    }

    // Get single comment
    public function show($id)
    {
        $comment = Comment::with('user')->findOrFail($id);

        return response()->json([
            'status' => 1,
            'message' => 'Comment retrieved successfully',
            'data' => $comment
        ]);
    }

    // Update a comment
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        // Only allow the owner to update
        if (Auth::id() !== $comment->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment->update(['body' => $request->body]);

        return response()->json([
            'status' => 1,
            'message' => 'Comment updated successfully',
            'data' => $comment
        ]);
    }

    // Delete a comment
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Comment deleted successfully'
        ]);
    }


}
