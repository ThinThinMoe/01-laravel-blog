@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @foreach ($posts as $post)
        <div>
            <h3><a href="{!! route('post.show', ['id' =>  $post->id]) !!}">{{ $post->title }}</a></h3>
            <i>{{ $post->created_at->diffForHumans() }}</i>
            by <b> {{ $post->user->name }} </b>
            <p>{{ $post->body }}</p>
            <p>
                @foreach ($post->categories as $key => $category)
                    @if ($key > 0)
                        {{ ', '  . $category->name }}
                    @else
                        {{ $category->name }}
                    @endif
                @endforeach
            </p>
            @if($post->isOwnPosts())
            <div class="d-flex justify-content-end">
                <a href="{!! route('post.edit', ['id' =>  $post->id]) !!}" class="btn btn-outline-success">Edit</a>
                <form action="{!! route('post.delete', ['id' => $post->id]) !!}" method="POST" onsubmit="return confirm('Are you sure to delete?')">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-outline-danger ms-2">Delete</button>
                </form>
            </div>
            @endif
        </div>
        <hr>
        @endforeach
        {{ $posts->links()}}
    </div>
@endsection
