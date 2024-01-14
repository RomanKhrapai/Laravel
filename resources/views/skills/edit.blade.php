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
            @foreach ($professions as $profession)
                <div class="btn row">
                    <label class='form-check-label'>
                        <input value="{{ $profession->id }}" type="radio" class="form-check-input block"
                            name="profession_id" {{ $profession->id == $skill->profession_id ? 'checked' : '' }}>
                        {{ $profession->name }}
                    </label>
                </div>
            @endforeach
        </div>

        @error('professions')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
