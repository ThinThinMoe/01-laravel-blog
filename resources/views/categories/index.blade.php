@extends('layouts.master')

@section('content')
    @foreach ($categories as $category)
    <div class="d-flex justify-content-between">
        <h3><a href="/categories/{{ $category->id }}">{{ $category->name }}</a></h3>
        <p>{{ $category->body }}</p>
        <div class="d-flex justify-content-end">
            <a href="/categories/{{ $category->id }}/edit/" class="btn btn-outline-success">Edit</a>
            <form action="/categories/{{ $category->id }}" method="POST" onsubmit="return confirm('Are you sure to delete?')">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-outline-danger ms-2">Delete</button>
            </form>
        </div>
    </div>
    <hr>
    @endforeach
@endsection
