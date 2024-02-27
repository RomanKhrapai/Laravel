@extends('layouts.admin')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>{{ ucfirst($review->name) }}</h1>
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
                            <h6>{{ $review->id }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>title</h5>
                        </td>
                        <td>
                            <h6>{{ $review->title }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>description</h5>
                        </td>
                        <td>
                            <h6>{{ $review->description }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>salary</h5>
                        </td>
                        <td>
                            <h6>{{ $review->salary }}</h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5> max salary </h5>
                        </td>
                        <td>
                            <h6>
                                <h6>

                                    @if ($review->max_salary)
                                        {{ $review->max_salary }}
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
                                {{ $review->company->name }}
                                ({{ $review->company_id }})
                            </h6>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>profession (id)</h5>
                        </td>
                        <td>
                            <h6>
                                {{ $review->profession->name }}
                                ({{ $review->profession_id }})
                            </h6>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>skills (id)</h5>
                        </td>
                        <td>
                            <ol class="mb-0">
                                @foreach ($review->skills as $skill)
                                    <li>{{ $skill->name }} ({{ $skill->id }})</li>
                                @endforeach
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>
                                @if ($review->area_id)
                                    area (id)
                                @else
                                    areas
                                @endif
                            </h5>
                        </td>
                        <td>
                            <h6>
                                @if ($review->area_id)
                                    {{ $review->area->name }}
                                    ({{ $review->area_id }})
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
                                {{ $review->nature->name }}
                                ({{ $review->nature_id }})
                            </h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h5>type (id)</h5>
                        </td>
                        <td>
                            <h6>
                                {{ $review->type->name }}
                                ({{ $review->type_id }})
                            </h6>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('reviews.index') }}" class="btn btn-info">Back</a>
    </div>
@endsection
