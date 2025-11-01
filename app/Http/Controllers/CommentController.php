<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        //
        $request->validate([
            'body' => 'required|string|min:3'
        ]);

        $post->comments()->create([
            'body' => $request->body,
            'user_id' => Auth::id()
        ]);

        return back()->with('succes', 'Komentar ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comments $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comments $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comments $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comments $comment)
    {
        //
        if ($comment->user_id !== Auth::id()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('Succes', 'Komentar dihapus');
    }
}
