@extends('layouts.admin')

@section('title')
    Form for creating companies
@endsection

@section('content')
    <h1 class="text-white">Form for creating companies</h1>

    <form action="{{ route('companies.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')

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
            <label class="text-white" for="mail">
                Email
            </label>
            <input type="text" name="mail" placeholder="Enter a email" id="mail" class="form-control"
                value="{{ old('mail') }}" class="@error('mail') is-invalid @enderror">
        </div>
        @error('mail')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="address">
                address
            </label>
            <input type="text" name="address" placeholder="Enter a address" id="address" class="form-control"
                value="{{ old('address') }}" class="@error('address') is-invalid @enderror">
        </div>
        @error('address')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class=" form-group">
            <label class="text-white d-block">
                Users:
                <br>
                <div class="form-control bg-white d-flex justify-content-around">
                    <select class="js-example-basic-single" name="user_id">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == old('user_id') ? 'selected' : '' }}>
                                {{ $user->id }} - {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </label>

        </div>
        @error('user_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection