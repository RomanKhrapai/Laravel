@extends('layouts.admin')

@section('title')
    All companys
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <h1 class="text-white">All companies</h1>
        <a href="{{ route('companies.create') }}" class="btn btn-primary">Create companies</a>
    </div>
    <table class="table table-bordered table-hover m-2 bg-white">
        <thead class="">
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col">foto url</th>
                <th scope="col">mail</th>
                <th scope="col">position</th>
                <th scope="col">address</th>
                <th scope="col">description</th>
                <th scope="col">owner name</th>
                <th scope="col">updated_at</th>
                <th scope="col">created_at</th>
                <th scope="col">Access buttons</th>
            </tr>
        </thead>

        @foreach ($companies as $company)
            <tbody>
                <tr>
                    <td>
                        <h5>{{ $company->id }}</h5>
                    </td>
                    <td>
                        <h5>{{ $company->name }}</h5>
                    </td>
                    <td>
                        <h6>{{ $company->foto_url }}</h6>
                    </td>
                    <td>
                        <h6>{{ $company->mail }}</h6>
                    </td>

                    <td>
                        <h6>{{ $company->position }}</h6>
                    </td>
                    <td>
                        <h6>{{ $company->address }}</h6>
                    </td>
                    <td>
                        <h6>{{ $company->description }}</h6>
                    </td>
                    <td>
                        <h6>{{ $company['user']->name }}</h6>
                    </td>
                    <td>
                        <h6>{{ $company->updated_at }}</h6>
                    </td>
                    <td>
                        <h6>{{ $company->created_at }}</h6>
                    </td>
                    <td>
                        <a href="{{ route('companies.show', $company->id) }}"><button class="btn btn-success">
                                <img src="{{ Vite::asset('resources/icons/view-show.svg') }}" alt="show" />
                            </button></a>

                        {{-- @can('update', $company) --}}
                        <a href="{{ route('companies.edit', $company->id) }}">
                            <button class="btn btn-warning">
                                <img src="{{ Vite::asset('resources/icons/pencil2.svg') }}" alt="edit" />
                            </button>
                        </a>
                        {{-- @endcan
                        @can('delete', $company) --}}
                        <button data-bs-toggle="modal" class="btn bg-secondary text-white"
                            data-bs-target="#deletecompanyModal_{{ $company->id }}"
                            data-action="{{ route('companies.destroy', $company->id) }}">
                            <img src="{{ Vite::asset('resources/icons/bin.svg') }}" alt="delete" />
                        </button>

                        {{-- @endcan --}}
                    </td>
                </tr>
            </tbody>

            <!-- Delete company Modal -->
            <div class="modal fade" id="deleteCompanyModal_{{ $company->id }}" data-backdrop="static" tabindex="-1"
                company="dialog" aria-labelledby="deleteCompanyModalLabel" aria-hidden="true">
                <div class="modal-dialog" company="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteCompanyModalLabel">This action is irreversible.</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('companies.destroy', $company->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <input id="id" name="$company->id" hidden value="">
                                <h5 class="text-center">Are you sure you want to delete this company?</h5>
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
        {{ $companies->withQueryString()->links() }}
    </div>
@endsection
