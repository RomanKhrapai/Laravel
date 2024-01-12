@extends('layouts.admin')

@section('title')
    All vacancies
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <h1 class="text-white">All vacancies</h1>
        <a href="{{ route('vacancies.create') }}" class="btn btn-primary">Create vacancies</a>
    </div>
    <table class="table table-bordered table-hover m-2 bg-white">
        <thead class="">
            <tr>
                <th scope="col">id</th>
                <th scope="col">title</th>
                <th scope="col">description</th>
                <th scope="col">company</th>
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

        @foreach ($vacancies as $vacancy)
            <tbody>
                <tr>
                    <td>
                        <h5>{{ $vacancy->id }}</h5>
                    </td>
                    <td>
                        <h5>{{ $vacancy->title }}</h5>
                    </td>
                    <td>
                        <h6>{{ $vacancy->description }}</h6>
                    </td>
                    <td>
                        <h6>
                            {{ $vacancy->company->name }}
                            ({{ $vacancy->company_id }})
                        </h6>
                    </td>
                    <td>
                        <h6>
                            @if ($vacancy->area_id)
                                {{ $vacancy->area->name }}
                                ({{ $vacancy->area_id }})
                            @else
                                All areas
                            @endif
                        </h6>
                    </td>
                    <td>
                        <h6>
                            {{ $vacancy->nature->name }}
                            ({{ $vacancy->nature_id }})
                        </h6>
                    </td>
                    <td>
                        <h6>
                            {{ $vacancy->type->name }}
                            ({{ $vacancy->type_id }})
                        </h6>
                    </td>
                    <td>
                        <h6>{{ $vacancy->salary }}</h6>
                    </td>
                    <td>
                        <h6>
                            @if ($vacancy->max_salary)
                                {{ $vacancy->max_salary }}
                            @else
                                -
                            @endif
                        </h6>
                    </td>
                    <td>
                        <h6>{{ $vacancy->updated_at }}</h6>
                    </td>
                    <td>
                        <h6>{{ $vacancy->created_at }}</h6>
                    </td>
                    <td>
                        <a href="{{ route('vacancies.show', $vacancy->id) }}"><button class="btn btn-success">
                                <img src="{{ Vite::asset('resources/icons/view-show.svg') }}" alt="show" />
                            </button></a>

                        {{-- @can('update', $vacancy) --}}
                        <a href="{{ route('vacancies.edit', $vacancy->id) }}">
                            <button class="btn btn-warning">
                                <img src="{{ Vite::asset('resources/icons/pencil2.svg') }}" alt="edit" />
                            </button>
                        </a>
                        {{-- @endcan
                        @can('delete', $vacancy) --}}
                        <button data-bs-toggle="modal" class="btn bg-secondary text-white"
                            data-bs-target="#deletevacancyModal_{{ $vacancy->id }}"
                            data-action="{{ route('vacancies.destroy', $vacancy->id) }}">
                            <img src="{{ Vite::asset('resources/icons/bin.svg') }}" alt="delete" />
                        </button>

                        {{-- @endcan --}}
                    </td>
                </tr>
            </tbody>

            <!-- Delete vacancy Modal -->
            <div class="modal fade" id="deleteVacancyModal_{{ $vacancy->id }}" data-backdrop="static" tabindex="-1"
                vacancy="dialog" aria-labelledby="deleteVacancyModalLabel" aria-hidden="true">
                <div class="modal-dialog" vacancy="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteVacancyModalLabel">This action is irreversible.</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('vacancies.destroy', $vacancy->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <input id="id" name="$vacancy->id" hidden value="">
                                <h5 class="text-center">Are you sure you want to delete this vacancy?</h5>
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
        {{ $vacancies->withQueryString()->links() }}
    </div>
@endsection
