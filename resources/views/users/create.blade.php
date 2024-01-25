@extends('layouts.admin')

@section('title')
    Form for creating users
@endsection

@section('content')
    <h1 class="text-white">
        Form for creating users</h1>

    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div>
            <label class="custom-label form__input">Image:
                <div id="fileInputshow">
                    <img loading="lazy" src="" height="320" width="479">
                </div>
                <input id="fileInput" type="file" name="img" accept=" image/jpeg" class=" custom-file-input "
                    data-url='{{ url(route('api.uploadAvatar')) }}'>
                <input type="hidden" name="image" id="input-image" value="{{ old('image') }}" />
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
                value="{{ old('name') }}" class="@error('name') is-invalid @enderror">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="email">
                Email
            </label>
            <input type="text" name="email" placeholder="Enter a email" id="email" class="form-control"
                value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
        </div>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="telephone">
                telephone
            </label>
            <input type="text" name="telephone" placeholder="Enter a telephone" id="telephone" class="form-control"
                value="{{ old('telephone') }}" class="@error('telephone') is-invalid @enderror">
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
                                {{ $role->id == old('role_id') ? 'checked' : '' }}>
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

        <div class="form-group">
            <label class="text-white" for="password_confirmation">
                confirm password
            </label>
            <input type="password" name="password_confirmation" placeholder="Enter a confirm password"
                id="password_confirmation" class="form-control"
                class="@error('password_confirmation') is-invalid @enderror">
        </div>
        @error('password_confirmation')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
