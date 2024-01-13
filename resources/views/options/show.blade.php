@extends('layouts.admin')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>{{ ucfirst($option->name) }} {{ $index }}</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">


            <table class="table table-striped">
                <thead>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">created_at</th>
                    <th scope="col">updated_at</th>
                </thead>

                <tr>
                    <td>{{ $option->id }}</td>
                    <td>{{ $option->name }}</td>
                    <td>{{ $option->created_at }}</td>
                    <td>{{ $option->updated_at }}</td>
                </tr>
            </table>
        </div>

    </div>
    <div class="mt-4">
        @can('update', $option)
            <a href="{{ route($titleIndex . '.edit', $option->id) }}" class="btn btn-info">Edit</a>
        @endcan
        <a href="{{ route($titleIndex . '.index') }}" class="btn btn-info">Back</a>
    </div>
@endsection
