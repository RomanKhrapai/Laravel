@extends('layouts.admin')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>{{ ucfirst($role->name) }} Role</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">

            <h3>Assigned permissions</h3>

            <table class="table table-striped">
                <thead>
                    <th scope="col">Name</th>
                </thead>
                @foreach ($role['permissions'] as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
    <div class="mt-4">
        @can('update', $role)
            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">Edit</a>
        @endcan
        <a href="{{ route('roles.index') }}" class="btn btn-info">Back</a>
    </div>
@endsection
