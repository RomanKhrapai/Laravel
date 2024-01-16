@extends('layouts.admin')

@section('title')
    All candidates
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <h1 class="text-white">All candidates</h1>
        @can('create', App\Models\Candidate::class)
            <a href="{{ route('candidates.create') }}" class="btn btn-primary">Create candidates</a>
        @endcan
    </div>
    <table class="table table-bordered table-hover m-2 bg-white">
        <thead class="">
            <tr>
                <th scope="col">id</th>
                <th scope="col">title</th>
                <th scope="col">description</th>
                <th scope="col">user</th>
                <th scope="col">profesion</th>
                <th scope="col">count skills</th>
                <th scope="col">area</th>
                <th scope="col">nature</th>
                <th scope="col">type</th>
                <th scope="col">salary</th>
                <th scope="col">max salary</th>
                <th scope="col">updated_at</th>
                <th scope="col">created_at</th>
                <th scope="col">Access buttons</th>
            </tr>
        </thead>

        @foreach ($candidates as $candidate)
            <tbody>
                <tr>
                    <td>
                        <h5>{{ $candidate->id }}</h5>
                    </td>
                    <td>
                        <h5>{{ $candidate->title }}</h5>
                    </td>
                    <td>
                        <h6>{{ $candidate->description }}</h6>
                    </td>
                    <td>
                        <h6>
                            {{ $candidate->user->name }}
                            ({{ $candidate->user_id }})
                        </h6>
                    </td>
                    <td>
                        <h6>
                            {{ $candidate->profession->name }}
                            ({{ $candidate->profession_id }})
                        </h6>
                    </td>
                    <td>
                        <h6>

                            {{ $candidate->skills->count() }}
                        </h6>
                    </td>
                    <td>
                        <h6>
                            @if ($candidate->area_id)
                                {{ $candidate->area->name }}
                                ({{ $candidate->area_id }})
                            @else
                                All areas
                            @endif
                        </h6>
                    </td>
                    <td>
                        <h6>
                            {{ $candidate->nature->name }}
                            ({{ $candidate->nature_id }})
                        </h6>
                    </td>
                    <td>
                        <h6>
                            {{-- {{ $candidate->type->name }}
                            ({{ $candidate->type_id }}) --}}
                            {{ $candidate->types->count() }}
                        </h6>
                    </td>
                    <td>
                        <h6>{{ $candidate->salary }}</h6>
                    </td>
                    <td>
                        <h6>
                            @if ($candidate->max_salary)
                                {{ $candidate->max_salary }}
                            @else
                                -
                            @endif
                        </h6>
                    </td>
                    <td>
                        <h6>{{ $candidate->updated_at }}</h6>
                    </td>
                    <td>
                        <h6>{{ $candidate->created_at }}</h6>
                    </td>
                    <td>
                        <a href="{{ route('candidates.show', $candidate->id) }}"><button class="btn btn-success">
                                <img src="{{ Vite::asset('resources/icons/view-show.svg') }}" alt="show" />
                            </button></a>

                        @can('update', $candidate)
                            <a href="{{ route('candidates.edit', $candidate->id) }}">
                                <button class="btn btn-warning">
                                    <img src="{{ Vite::asset('resources/icons/pencil2.svg') }}" alt="edit" />
                                </button>
                            </a>
                        @endcan
                        @can('delete', $candidate)
                            <button data-bs-toggle="modal" class="btn bg-secondary text-white"
                                data-bs-target="#deletecandidateModal_{{ $candidate->id }}"
                                data-action="{{ route('candidates.destroy', $candidate->id) }}">
                                <img src="{{ Vite::asset('resources/icons/bin.svg') }}" alt="delete" />
                            </button>
                        @endcan
                    </td>
                </tr>
            </tbody>

            <!-- Delete candidate Modal -->
            <div class="modal fade" id="deletecandidateModal_{{ $candidate->id }}" data-backdrop="static" tabindex="-1"
                candidate="dialog" aria-labelledby="deletecandidateModalLabel" aria-hidden="true">
                <div class="modal-dialog" candidate="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deletecandidateModalLabel">This action is irreversible.</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('candidates.destroy', $candidate->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <input id="id" name="$candidate->id" hidden value="">
                                <h5 class="text-center">Are you sure you want to delete this candidate?</h5>
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
        {{ $candidates->withQueryString()->links() }}
    </div>
@endsection
