@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Category Detail</h3>
        </div>
        <div class="card-body">
            <h3>{{ $category->name }}</h3>
        </div>
        <div class="card-footer">
            <a href="/categories">Go Home</a>
        </div>
    </div>
@endsection
