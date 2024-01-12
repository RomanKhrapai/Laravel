@extends('layouts.admin')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>{{ ucfirst($vacancy->name) }}</h1>
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
                            <h6>{{ $vacancy->id }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>title</h5>
                        </td>
                        <td>
                            <h6>{{ $vacancy->title }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>description</h5>
                        </td>
                        <td>
                            <h6>{{ $vacancy->description }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>salary</h5>
                        </td>
                        <td>
                            <h6>{{ $vacancy->salary }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5> max salary </h5>
                        </td>
                        <td>
                            <h6>
                                <h6>

                                    @if ($vacancy->max_salary)
                                        {{ $vacancy->max_salary }}
                                    @else
                                        -
                                    @endif
                                </h6>
                            </h6>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>company (id)</h5>
                        </td>
                        <td>
                            <h6>
                                {{ $vacancy->company->name }}
                                ({{ $vacancy->company_id }})
                            </h6>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>
                                @if ($vacancy->area_id)
                                    area (id)
                                @else
                                    areas
                                @endif
                            </h5>
                        </td>
                        <td>
                            <h6>
                                <h6>
                                    @if ($vacancy->area_id)
                                        {{ $vacancy->area->name }}
                                        ({{ $vacancy->area_id }})
                                    @else
                                        All areas
                                    @endif
                                </h6>
                            </h6>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>nature (id)</h5>
                        </td>
                        <td>
                            <h6>
                                <h6>
                                    {{ $vacancy->nature->name }}
                                    ({{ $vacancy->nature_id }})
                                </h6>
                            </h6>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>type (id)</h5>
                        </td>
                        <td>
                            <h6>
                                <h6>
                                    {{ $vacancy->type->name }}
                                    ({{ $vacancy->type_id }})
                                </h6>
                            </h6>

                        </td>
                    </tr>


                </tbody>
            </table>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('vacancies.edit', $vacancy->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('vacancies.index') }}" class="btn btn-info">Back</a>
    </div>
@endsection
