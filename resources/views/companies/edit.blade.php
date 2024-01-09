@extends('layouts.admin')

@section('title')
    Form for updating users
@endsection

@section('content')
    <h1 class="text-white">Form for updating users</h1>
    {{-- {{ dd($user) }} --}}
    <span class="text-white">
        ID: {{ $user->id }}
    </span>
    <form class="" action="{{ route('users.update', ['user' => $user->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label class="text-white" for="name">
                name
            </label>
            <input type="text" name="name" placeholder="Enter a name" id="name" class="form-control"
                value="{{ $user->name }}" class="@error('name') is-invalid @enderror">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="mail">
                Email
            </label>
            <input type="text" name="mail" placeholder="Enter a email" id="mail" class="form-control"
                value="{{ $user->mail }}" class="@error('mail') is-invalid @enderror">
        </div>
        @error('mail')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="telephone">
                telephone
            </label>
            <input type="text" name="telephone" placeholder="Enter a telephone" id="telephone" class="form-control"
                value="{{ $user->telephone }}" class="@error('telephone') is-invalid @enderror">
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
                                {{ $role->id == $user->role_id ? 'checked' : '' }}>
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
@endsection
