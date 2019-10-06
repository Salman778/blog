@extends('template')
@section('content')
    <div class="container">
        <h1>Post a Moment</h1>
        <hr/>
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @method('PUT')
            {{ csrf_field() }}
            <label for="title">Moment Title:</label>
            <input value="{{ $post->title}}" type="text" id="title" name="title" class="form-control"/>
            
            <label for="image_url">Moment Image:</label>
            <input value="{{ $post->image_url}}" type="text" id="image_url" name="image_url" class="form-control"/>

            <label for="body">About Moment:</label>
            <textarea name="body" id="body" rows="10" class="form-control">{{ $post->body}}</textarea>
            <input type="submit" class="btn btn-primary" value="Submit Moment">
        </form>
    </div>
@endsection