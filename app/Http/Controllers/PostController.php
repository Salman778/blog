<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Auth;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', ['posts' => Post::orderBy('id', 'desc')->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
           'title' => 'required|max:140',
           'body' => 'required|min:15|max:600'
       ]);

       $post = new Post();
       $post->title = $request->title;
       $post->body = $request->body;
       $post->image_url = $request->image_url;
       $post->user()->associate(Auth::id());

       if ($post->save())
            return redirect()->route('posts.show', $post->id);
       else
            return redirect()->route('posts.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show', ['post' => Post::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        if ($post->user->id === Auth::id())
            return view('posts.edit', ['post' => $post]);
        else
            return abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($post->user->id === Auth::id()){
            $this->validate($request, [
                'title' => 'required|max:140',
                'body' => 'required|min:15|max:600'
            ]);
            Post::where('id', $id)->update([
                'title' => $request->title,
                'image_url' => $request->image_url,
                'body' => $request->body
            ]);
            return redirect()->route('posts.show', $id);
        }
        else
            return abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        if ($post->user->id === Auth::id()) 
            Post::find($id)->delete();
        else
            return abort(403);

        return redirect()->route('posts.index');
    }
}
