@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Create A Post</h3>
        </div>
        <div class="card-body">
            <form action="/posts" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Post Title</label>
                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') }}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Post Body</label>
                    <textarea class="form-control  @error('body') is-invalid @enderror" name="body" rows="5">{{ old('body') }}</textarea>
                    @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-outline-primary">Create</button>
                    <a href="/posts" class="btn btn-outline-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
