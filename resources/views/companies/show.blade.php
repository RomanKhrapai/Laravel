@extends('layouts.admin')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Company {{ ucfirst($company->name) }}</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">

            @empty(!$company->image)
                <img loading="lazy" src="{{ Storage::url($company->image) }}" height="60" width="47"></img>
            @endempty

            <table class="table table-striped">
                <thead>
                    <th scope="col">field name</th>
                    <th scope="col">value</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <h5>ID</h5>
                        </td>
                        <td>
                            <h6>{{ $company->id }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>name</h5>
                        </td>
                        <td>
                            <h6>{{ $company->name }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>address</h5>
                        </td>
                        <td>
                            <h6>{{ $company->address }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>description</h5>
                        </td>
                        <td>
                            <h6>{{ $company->description }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>user id (user)</h5>
                        </td>
                        <td>
                            <h6>{{ $company->user_id }} ({{ $company->user->name }})</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>image</h5>
                        </td>
                        <td>
                            <h6>{{ $company->image }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>created at</h5>
                        </td>
                        <td>
                            <h6>{{ $company->created_at }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>updated at</h5>
                        </td>
                        <td>
                            <h6>{{ $company->updated_at }}</h6>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('companies.index') }}" class="btn btn-info">Back</a>
    </div>
@endsection
