@extends('layouts.master')

@section('title', "My Posts")

@section('content')

<ul>
    @foreach($posts as $post)
    <li>
        {{ $post->title }}
    </li>
    @endforeach
</ul>

@endsection