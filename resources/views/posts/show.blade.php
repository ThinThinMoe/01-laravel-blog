@extends('app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Post Detail</h3>
        </div>
        <div class="card-body">
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->body }}</p>
        </div>
        <div class="card-footer">
            <a href="/posts">Go Home</a>
        </div>
    </div>
@endsection

