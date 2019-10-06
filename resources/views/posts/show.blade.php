@extends('template')
@section('content')
    <div class="container">
        <div class="well">
            <h3>{{ $post->title }}</h3>
            <img src={{ $post->image_url}} class="img-rounded" width="700px" height="500px">
            <br><br>
            <p class="lead">{{ $post->body }}</p>
            <p>{{ $post->user->name }}, {{ $post->created_at->diffForHumans() }}</p>
            @if (Auth::id() === $post->user->id)
                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="post" style="display:inline">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="delete">
                    <input class="btn btn-link" type="submit" value="Delete"/>
                </form>  
            @endif
        </div>

        @if ($post->comments->count())
            @foreach ($post->comments as $comment)
                <div class="panel panel-default">
                    <div class="panel-body">
                    <p>{{ $comment->content }}</p>
                    <h6>{{ $comment->user->name }}, {{ $comment->created_at->diffForHumans() }}</h6>
                    @if ($comment->user->id === Auth::id())
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="delete">
                            <input class="btn btn-link" type="submit" value="Delete"/>
                        </form>                        
                    @endif
                    
                    </div>
                </div>
            @endforeach
        @elseif(Auth::id() === $post->user->id)
            <p>No Comments for your moment!!</p>
        @elseif(Auth::id())
            <p>No Comments yet!!</p>
            <b>Be first one</b>
        @else
            <p>No Comments yet!!</p>
            <h6>
                <a href="{{ route('register') }}">Register</a> or 
                <a href="{{ route('login') }}">login</a> 
                to <b>Be first one</b> 
            </h6>
            
        @endif
        
        @if (Auth::id() and (Auth::id() !== $post->user->id))
            <form action="{{ route('comments.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" value="{{ $post->id }}" name="post_id">
                <h1>Submit a Comment:</h1>
                <textarea class="form-control" name="content" id="content"  rows="4"></textarea>
                <br/>
                <button class="btn btn-primary">Submit Comment</button>
            </form> 
        @elseif(!Auth::id() and $post->comments->count())
            <h6>
                <a href="{{ route('register') }}">Register</a> or 
                <a href="{{ route('login') }}">login</a> 
                to <b>write a comment</b> 
            </h6>
        @endif
        
    </div>
@endsection