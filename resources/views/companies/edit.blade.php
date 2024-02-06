@extends('layouts.admin')

@section('title')
    Form for updating companies
@endsection

@section('content')
    <h1 class="text-white">Form for updating companies</h1>
    <span class="text-white">
        ID: {{ $company->id }}
    </span>
    <form class="" action="{{ route('companies.update', ['company' => $company->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div>
            <label class="custom-label form__input">Image:
                <div id="fileInputshow">
                    <img loading="lazy" src="{{ Storage::url($company->image) }}" height="320" width="479">
                </div>
                <input id="fileInput" type="file" name="img" accept=" image/jpeg" class=" custom-file-input "
                    data-url='{{ url(route('api.upload')) }}'>
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
                value="{{ old('name', $company->name) }}" class="@error('name') is-invalid @enderror">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="description">
                description
            </label>
            <input type="text" name="description" placeholder="Enter a description" id="description" class="form-control"
                value="{{ old('description', $company->description) }}" class="@error('description') is-invalid @enderror">
        </div>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label class="text-white" for="address">
                address
            </label>
            <input type="text" name="address" placeholder="Enter a address" id="address" class="form-control"
                value="{{ old('address', $company->address) }}" class="@error('address') is-invalid @enderror">
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
                            <option value="{{ $user->id }}"
                                {{ $user->id == old('user_id', $company->user_id) ? 'selected' : '' }}>
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
