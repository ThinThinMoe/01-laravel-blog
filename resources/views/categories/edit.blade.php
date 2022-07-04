@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Edit A Category</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('category.update', ['id' => $category->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $category->name }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-outline-primary">Update</button>
                    <a href="{{ route('category.index') }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
