<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;
use App\Post;
use Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|min:12',
            'post_id' => 'required|integer'
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user()->associate(Auth::id());

        $post = Post::findOrFail($request->post_id);

        if($post->user->id === Auth::id())
            return abort(403);

        $post->comments()->save($comment);

        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $post = Post::findOrFail($comment->post->id);
        
        if ($comment->user->id === Auth::id()) 
            Comment::find($id)->delete();
        else
            return abort(403);

        return redirect()->route('posts.show', $post->id);
    }
}
