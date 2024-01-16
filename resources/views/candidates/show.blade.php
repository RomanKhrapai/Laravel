@extends('layouts.admin')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>{{ ucfirst($candidate->name) }}</h1>
        <div class="lead">

        </div>

        <div class="container mt-4">


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
                            <h6>{{ $candidate->id }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>title</h5>
                        </td>
                        <td>
                            <h6>{{ $candidate->title }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>description</h5>
                        </td>
                        <td>
                            <h6>{{ $candidate->description }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>salary</h5>
                        </td>
                        <td>
                            <h6>{{ $candidate->salary }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5> max salary </h5>
                        </td>
                        <td>
                            <h6>
                                <h6>

                                    @if ($candidate->max_salary)
                                        {{ $candidate->max_salary }}
                                    @else
                                        -
                                    @endif
                                </h6>
                            </h6>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>user (id)</h5>
                        </td>
                        <td>
                            <h6>
                                {{ $candidate->user->name }}
                                ({{ $candidate->user_id }})
                            </h6>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>profession (id)</h5>
                        </td>
                        <td>
                            <h6>
                                {{ $candidate->profession->name }}
                                ({{ $candidate->profession_id }})
                            </h6>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>skills (id)</h5>
                        </td>
                        <td>
                            <ol class="mb-0">
                                @foreach ($candidate->skills as $skill)
                                    <li>{{ $skill->name }} ({{ $skill->id }})</li>
                                @endforeach
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>
                                @if ($candidate->area_id)
                                    area (id)
                                @else
                                    areas
                                @endif
                            </h5>
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
                    </tr>
                    <tr>
                        <td>
                            <h5>nature (id)</h5>
                        </td>
                        <td>
                            <h6>
                                {{ $candidate->nature->name }}
                                ({{ $candidate->nature_id }})
                            </h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>types (id)</h5>
                        </td>
                        <td>
                            <ol class="mb-0">
                                @foreach ($candidate->types as $type)
                                    <li>{{ $type->name }} ({{ $type->id }})</li>
                                @endforeach
                            </ol>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('candidates.edit', $candidate->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('candidates.index') }}" class="btn btn-info">Back</a>
    </div>
@endsection
