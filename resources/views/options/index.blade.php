@extends('layouts.admin')

@section('title')
    All {{ $titleIndex }}
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <h1 class="text-white">All {{ $titleIndex }}</h1>
        <a href="{{ route($titleIndex . '.create') }}" class="btn btn-primary">Create {{ $index }}</a>
    </div>

    <table class="table table-bordered table-hover bg-white">
        <thead class="">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at</th>
                <th scope="col">Access buttons</th>
            </tr>
        </thead>

        @foreach ($options as $option)
            <tbody>
                <tr>
                    <td> {{ $option->id }} </td>
                    <td> {{ $option->name }} </td>
                    <td> {{ $option->created_at }} </td>
                    <td> {{ $option->updated_at }} </td>
                    <td>
                        <a href="{{ route($titleIndex . '.show', $option->id) }}">
                            <button class="btn btn-success">
                                <img src="{{ Vite::asset('resources/icons/view-show.svg') }}" alt="show" />
                            </button>
                        </a>
                        {{-- @can('update', $area) --}}
                        <a href="{{ route($titleIndex . '.edit', $option->id) }}">
                            <button class="btn btn-warning">
                                <img src="{{ Vite::asset('resources/icons/pencil2.svg') }}" alt="edit" />
                            </button>
                        </a>
                        {{-- @endcan --}}
                        {{-- @can('delete', $area) --}}
                        <button data-bs-toggle="modal" class="btn bg-secondary text-white"
                            data-bs-target="#deleteareaModal_{{ $option->id }}"
                            data-action="{{ route($titleIndex . '.destroy', $option->id) }}">
                            <img src="{{ Vite::asset('resources/icons/bin.svg') }}" alt="delete" />
                        </button>
                        {{-- @endcan --}}
                    </td>
                </tr>
            </tbody>

            <!-- Delete area Modal -->
            <div class="modal fade" id="deleteareaModal_{{ $option->id }}" data-backdrop="static" tabindex="-1"
                area="dialog" aria-labelledby="deleteareaModalLabel" aria-hidden="true">
                <div class="modal-dialog" area="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteareaModalLabel">This action is irreversible.</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route($titleIndex . '.destroy', $option->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <input id="id" name="$area->id" hidden value="">
                                <h5 class="text-center">Are you sure you want to delete this {{ $index }}?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Yes, delete {{ $index }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </table>

    <div class="mt-3">
        {{ $options->withQueryString()->links() }}
    </div>
@endsection
