@extends('layouts.admin')

@section('title')
    All roles
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <h1 class="text-white">All roles</h1>
        @can('create', App\Models\Role::class)
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Create roles</a>
        @endcan
    </div>

    <table class="table table-bordered table-hover bg-white">
        <thead class="">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Role name</th>
                <th scope="col">Access buttons</th>
            </tr>
        </thead>

        @foreach ($roles as $role)
            <tbody>
                <tr>
                    <td>
                        <h5>{{ $role->id }}</h5>
                    </td>
                    <td>
                        <h5>{{ $role->name }}</h5>
                    </td>
                    <td>
                        <a href="{{ route('roles.show', $role->id) }}">
                            <button class="btn btn-success">
                                <img src="{{ Vite::asset('resources/icons/view-show.svg') }}" alt="show" />
                            </button>
                        </a>
                        @can('update', $role)
                            <a href="{{ route('roles.edit', $role->id) }}">
                                <button class="btn btn-warning">
                                    <img src="{{ Vite::asset('resources/icons/pencil2.svg') }}" alt="edit" />
                                </button>
                            </a>
                        @endcan
                        @can('delete', $role)
                            <button data-bs-toggle="modal" class="btn bg-secondary text-white"
                                data-bs-target="#deleteRoleModal_{{ $role->id }}"
                                data-action="{{ route('roles.destroy', $role->id) }}">
                                <img src="{{ Vite::asset('resources/icons/bin.svg') }}" alt="delete" />
                            </button>
                        @endcan
                    </td>
                </tr>
            </tbody>

            <!-- Delete Role Modal -->
            <div class="modal fade" id="deleteRoleModal_{{ $role->id }}" data-backdrop="static" tabindex="-1"
                role="dialog" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteRoleModalLabel">This action is irreversible.</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <input id="id" name="$role->id" hidden value="">
                                <h5 class="text-center">Are you sure you want to delete this role?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Yes, delete post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </table>

    <div class="mt-3">
        {{ $roles->withQueryString()->links() }}
    </div>
@endsection
