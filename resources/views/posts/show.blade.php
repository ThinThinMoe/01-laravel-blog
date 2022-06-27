@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Post Detail</h3>
        </div>
        <div class="card-body">
            <h3>{{ $post->title }}</h3>
            <p>Post by <b> {{ $post->user->name }} </b> on <i>{{ $post->created_at->diffForHumans() }}</i></p>
            <p>{{ $post->body }}</p>
        </div>
        <div class="card-footer">
            <a href="/posts">Go Home</a>
        </div>
    </div>
@endsection
