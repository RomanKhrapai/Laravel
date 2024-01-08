@extends('layouts.admin')

@section('title')
    Form for updating {{ $titleIndex }}
@endsection

@section('content')
    <h1 class="text-white">Form for updating {{ $titleIndex }}</h1>

    <form class="" action="{{ route($titleIndex . '.update', [$index => $option->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input value="{{ $option->name }}" type="text" class="form-control" name="name" placeholder="Name" required>
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
