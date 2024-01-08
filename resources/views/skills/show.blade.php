@extends('layouts.admin')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>{{ ucfirst($skill->name) }} Skill</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">

            <h3>Assigned permissions</h3>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">category</th>
                        <th scope="col">created_at</th>
                        <th scope="col">updated_at</th>
                    </tr>
                </thead>

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

            </table>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('skills.index') }}" class="btn btn-info">Back</a>
    </div>
@endsection
