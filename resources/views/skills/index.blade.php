@extends('layouts.admin')

@section('title')
    All skills
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <h1 class="text-white">All skills</h1>
        @can('create', App\Models\Skill::class)
            <a href="{{ route('skills.create') }}" class="btn btn-primary">Create skills</a>
        @endcan
    </div>
    <table class="table table-bordered table-hover bg-white">
        <thead class="">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">category</th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at</th>
                <th scope="col">Access buttons</th>
            </tr>
        </thead>

        @foreach ($skills as $skill)
            <tbody>
                <tr>
                    <td>
                        <h5>{{ $skill->id }}</h5>
                    </td>
                    <td>
                        <h5>{{ $skill->name }}</h5>
                    </td>
                    <td>
                        <h5>{{ $skill['category']->name }}</h5>
                    </td>
                    <td>
                        <h5>{{ $skill->created_at }}</h5>
                    </td>
                    <td>
                        <h5>{{ $skill->updated_at }}</h5>
                    </td>
                    <td>
                        <a href="{{ route('skills.show', $skill->id) }}">
                            <button class="btn btn-success">
                                <img src="{{ Vite::asset('resources/icons/view-show.svg') }}" alt="show" />
                            </button>
                        </a>
                        @can('update', $skill)
                            <a href="{{ route('skills.edit', $skill->id) }}">
                                <button class="btn btn-warning">
                                    <img src="{{ Vite::asset('resources/icons/pencil2.svg') }}" alt="edit" />
                                </button>
                            </a>
                        @endcan
                        @can('delete', $skill)
                            <button data-bs-toggle="modal" class="btn bg-secondary text-white"
                                data-bs-target="#deleteSkillModal_{{ $skill->id }}"
                                data-action="{{ route('skills.destroy', $skill->id) }}">
                                <img src="{{ Vite::asset('resources/icons/bin.svg') }}" alt="delete" />
                            </button>
                        @endcan
                    </td>
                </tr>
            </tbody>

            <!-- Delete Skill Modal -->
            <div class="modal fade" id="deleteSkillModal_{{ $skill->id }}" data-backdrop="static" tabindex="-1"
                skill="dialog" aria-labelledby="deleteSkillModalLabel" aria-hidden="true">
                <div class="modal-dialog" skill="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteSkillModalLabel">This action is irreversible.</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('skills.destroy', $skill->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <input id="id" name="$skill->id" hidden value="">
                                <h5 class="text-center">Are you sure you want to delete this skill?</h5>
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
        {{ $skills->withQueryString()->links() }}
    </div>
@endsection
