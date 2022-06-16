@extends('app')

@section('content')
    @foreach ($posts as $post)
    <div>
        <h3><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h3>
        January 1, 2021 by Mark
        <p>{{ $post->body }}</p>
        <div class="d-flex justify-content-end">
            <a href="/posts/{{ $post->id }}/edit/" class="btn btn-outline-success">Edit</a>
            <form action="/posts/{{ $post->id }}" method="POST" onsubmit="return confirm('Are you sure to delete?')">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-outline-danger ms-2">Delete</button>
            </form>
        </div>
    </div>

    <hr>
    @endforeach
@endsection
