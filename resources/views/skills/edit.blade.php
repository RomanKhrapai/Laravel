@extends('layouts.admin')

@section('title')
    Form for updating skills
@endsection

@section('content')
    <h1 class="text-white">Form for updating skills</h1>

    <form class="" action="{{ route('skills.update', ['skill' => $skill->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input value="{{ $skill->name }}" type="text" class="form-control" name="name" placeholder="Name" required>
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror


        <div class="bg-white">
            @foreach ($categories as $category)
                <div class="btn row">
                    <label class='form-check-label'>
                        <input value="{{ $category->id }}" type="radio" class="form-check-input block" name="category_id"
                            {{ $category->id == $skill->category_id ? 'checked' : '' }}>
                        {{ $category->name }}
                    </label>
                </div>
            @endforeach
        </div>

        @error('categories')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
