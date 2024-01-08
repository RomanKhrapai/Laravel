@extends('layouts.admin')

@section('title')
    All users
@endsection

@section('content')
    <h1 class="text-white">All users</h1>
    <table class="table table-bordered table-hover m-2 bg-white">
        <thead class="">
            <tr>
                <th scope="col">user name</th>
                <th scope="col">user email</th>
                <th scope="col">user foto url</th>
                <th scope="col">user telephone</th>
                <th scope="col">user role</th>
                <th scope="col">updated_at</th>
                <th scope="col">created_at</th>
                <th scope="col">Access buttons</th>
            </tr>
        </thead>

        @foreach ($users as $user)
            <tbody>
                <tr>
                    <td>
                        <h5>{{ $user->name }}</h5>
                    </td>
                    <td>
                        <h6>{{ $user->mail }}</h6>
                    </td>
                    <td>
                        <h6>{{ $user->foto_url }}</h6>
                    </td>
                    <td>
                        <h6>{{ $user->telephone }}</h6>
                    </td>
                    <td>
                        <h6>{{ $user['role']->name }}</h6>
                    </td>
                    <td>
                        <h6>{{ $user->updated_at }}</h6>
                    </td>
                    <td>
                        <h6>{{ $user->created_at }}</h6>
                    </td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}"><button class="btn btn-success">
                                <img src="{{ Vite::asset('resources/icons/view-show.svg') }}" alt="show" />
                            </button></a>

                        {{-- @can('update', $user) --}}
                        <a href="{{ route('users.edit', $user->id) }}">
                            <button class="btn btn-warning">
                                <img src="{{ Vite::asset('resources/icons/pencil2.svg') }}" alt="edit" />
                            </button>
                        </a>
                        {{-- @endcan
                        @can('delete', $user) --}}
                        <button data-bs-toggle="modal" class="btn bg-secondary text-white"
                            data-bs-target="#deleteuserModal_{{ $user->id }}"
                            data-action="{{ route('users.destroy', $user->id) }}">
                            <img src="{{ Vite::asset('resources/icons/bin.svg') }}" alt="delete" />
                        </button>

                        {{-- @endcan --}}
                    </td>
                </tr>
            </tbody>

            <!-- Delete user Modal -->
            <div class="modal fade" id="deleteuserModal_{{ $user->id }}" data-backdrop="static" tabindex="-1"
                user="dialog" aria-labelledby="deleteuserModalLabel" aria-hidden="true">
                <div class="modal-dialog" user="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteuserModalLabel">This action is irreversible.</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('users.destroy', $user->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <input id="id" name="$user->id" hidden value="">
                                <h5 class="text-center">Are you sure you want to delete this user?</h5>
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
        {{ $users->withQueryString()->links() }}
    </div>
@endsection
