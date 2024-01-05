@extends('layouts.admin')

@section('title')
    Form for updating roles
@endsection

@section('content')
    <h1 class="text-white">Form for updating roles</h1>

    <form class="" action="{{ route('roles.update', ['role' => $role->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input value="{{ $role->name }}" type="text" class="form-control" name="name" placeholder="Name" required>
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror


        <div class="bg-white">
            @foreach ($permissions as $permission)
                <div class="btn row">
                    <label class='form-check-label'> <input value="{{ $permission->id }}" type="checkbox"
                            class="form-check-input block" name="permissions[]"
                            @if ($role->permissions->contains($permission->id)) checked @endif> {{ $permission->name }} </label>
                </div>
            @endforeach
        </div>
      
        @error('permissions')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
