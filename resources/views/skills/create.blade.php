@extends('layouts.admin')

@section('title')
    Form for creating skills
@endsection

@section('content')
    <h1 class="text-white">Form for creating skills</h1>

    <form action="{{ route('skills.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" placeholder="Enter a name" id="name" class="form-control"
                value="{{ old('name') }}" class="@error('name') is-invalid @enderror">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="bg-white">
            @foreach ($professions as $profession)
                <div class="btn row">
                    <label class='form-check-label'> <input value="{{ $profession->id }}" type="radio"
                            class="form-check-input block" name="profession_id"
                            {{ in_array($profession->id, old('professions', [])) ? 'checked' : '' }}>
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
