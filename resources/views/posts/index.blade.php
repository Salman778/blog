@extends('template')
@section('content')
    <div class="container">
        <h1>Recent Moment:</h1>
        <hr />
        @foreach ($posts as $post)
            <div class="well">
            <h3>{{ $post->title }}</h3>
            <img src={{ $post->image_url}} class="img-rounded" width="400px" height="300px"><br><br>
            <a href={{ route('posts.show', $post->id) }} class="btn btn-primary btn-sm">View More</a> 
            </div>
        @endforeach
    </div>
    {{ $posts->links() }}
@endsection