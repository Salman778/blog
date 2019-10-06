@extends('template')
@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1>Share Your Moment!</h1>
            <p>We can not wait to see your moment!</p>
            <p>
            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-lg" role="button">Share Now!</a>
            </p>
        </div>
    </div>
@endsection