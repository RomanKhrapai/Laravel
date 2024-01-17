@extends('layouts.admin')

@section('title')
    Form for updating users
@endsection

@section('content')
    <h1 class="text-white">Form for updating users</h1>
    <span class="text-white">
        ID: {{ $user->id }}
    </span>
    <form class="" action="{{ route('users.update', ['user' => $user->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div>
            <label class="custom-label form__input">Image:
                <div id="fileInputshow">
                    <img loading="lazy" src="{{ $user->image }}" height="320" width="479">
                </div>
                <input id="fileInput" type="file" name="img" accept=" image/jpeg" class=" custom-file-input "
                    data-url='{{ url(route('api.uploadAvatar')) }}'>
                <button id="remove-image">remove image</button>
                <input type="hidden" name="image" id="input-image" value="{{ old('image'), '' }}" />
            </label>
        </div>

        <div id=image-error>
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="text-white" for="name">
                name
            </label>
            <input type="text" name="name" placeholder="Enter a name" id="name" class="form-control"
                value="{{ old('name', $user->name) }}" class="@error('name') is-invalid @enderror">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="email">
                Email
            </label>
            <input type="text" name="email" placeholder="Enter a email" id="email" class="form-control"
                value="{{ old('email', $user->email) }}" class="@error('email') is-invalid @enderror">
        </div>
        @error('mail')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="telephone">
                telephone
            </label>
            <input type="text" name="telephone" placeholder="Enter a telephone" id="telephone" class="form-control"
                value="{{ old('telephone', $user->telephone) }}" class="@error('telephone') is-invalid @enderror">
        </div>
        @error('telephone')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class=" form-group">
            <label class="text-white d-block">
                Role:
                <br>
                <div class="form-control bg-white d-flex justify-content-around">
                    @foreach ($roles as $role)
                        <label class='form-check-label'><input value="{{ $role->id }}" type="radio"
                                class="form-check-input block" name="role_id"
                                {{ $role->id == old('role_id', $user->role_id) ? 'checked' : '' }}>
                            {{ $role->name }}
                        </label>
                    @endforeach
                </div>

            </label>

        </div>
        @error('roles')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="password">
                password
            </label>
            <input type="password" name="password" placeholder="Enter a password" id="password" class="form-control"
                class="@error('password') is-invalid @enderror">
        </div>
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror


        <button type="submit" class="btn btn-success">Submit</button>
    </form>
    <a href="{{ URL::previous() }}" class="btn btn-info">Back</a>
@endsection
