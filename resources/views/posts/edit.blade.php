@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edit A Post</h3>
        </div>
        <div class="card-body">
            <form action="{!! route('post.update', ['id' =>  $post->id]) !!}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Post Title</label>
                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ $post->title }}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Post Body</label>
                    <textarea class="form-control  @error('body') is-invalid @enderror" name="body" rows="5">{{ $post->body }}</textarea>
                    @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Select Categories</label>
                    <select class="form-select form-select-sm" multiple name="categories[]">
                        @php
                            $postCategories = [];
                        @endphp
                        @foreach ($post->categories as $post_category)
                            @php
                                $postCategories[] = $post_category->id;
                            @endphp
                        @endforeach
                        @foreach ($categories as $category)
                            @if (in_array($category->id, $postCategories))
                                <option selected value="{{ $category->id }}"> {{ $category->name }} </option>
                            @else
                                <option value="{{ $category->id }}"> {{ $category->name }} </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-outline-primary">Update</button>
                    <a href="{{ route('post.index') }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
