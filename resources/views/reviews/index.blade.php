@extends('layouts.admin')

@section('title')
    All reviews
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <h1 class="text-white">All reviews</h1>

        <div class="filter">
            <label class="text-white ">
                Field filter:
                <br>
                <div class="form-control bg-white d-flex justify-content-around">
                    <select id="filter_select" class="js-example-basic-single">
                        @foreach ($filterFiels as $fiel)
                            @php
                                $oldSearch = request($fiel) ? $fiel : $oldSearch ?? $filterFiels[0];

                            @endphp
                            <option value="{{ $fiel }}" {{ request($fiel) ? 'selected' : '' }}>
                                {{ $fiel }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </label>
            <form
                action="{{ route('reviews.index', [
                    'sort_by' => request('sort_by'),
                    'sort_order' => request('sort_order'),
                ]) }}">
                <input type="hidden" name="sort_by" value="{{ request('sort_by') ?? '' }}">
                <input type="hidden" name="sort_order" value="{{ request('sort_order') ?? '' }}">
                <label class="text-white ml-4" for="search">
                    search
                    <div>
                        <input type="text" name="{{ $oldSearch }}" placeholder="Enter a search" id="filter_search"
                            class="form-control" value="{{ request($oldSearch) }}">
                    </div>
                </label>
                <button type="submit" id="filtre_btn" class="filter_btn"> search</button>
            </form>

        </div>



        {{-- @can('create', App\Models\Review::class)
            <a href="{{ route('reviews.create') }}" class="btn btn-primary">Create reviews</a>
        @endcan --}}
    </div>
    <table class="table table-bordered table-hover m-2 bg-white">
        <thead class="">
            <tr>
                @foreach ($sortArray as $item)
                    @include('components.title-sort', [
                        'title' => $item[0],
                        'sort_by' => $item[1],
                        'path' => 'reviews.index',
                        'oldSearch' => $oldSearch,
                    ])
                @endforeach
            </tr>
        </thead>

        @foreach ($reviews as $review)
            <tbody>
                <tr>
                    <td>
                        <h5>{{ $review->id }}</h5>
                    </td>
                    <td>
                        <h5>{{ $review->parent_id }}</h5>
                    </td>
                    <td>
                        <h6>{{ $review->user_id }}</h6>
                    </td>
                    <td>
                        <h6>{{ $review->company_id }}</h6>
                    </td>
                    <td>
                        <h6>
                            {{ $review->evaluated_user_id }}
                        </h6>
                    </td>
                    <td>
                        <h6>
                            {{ $review->evaluated_company_id }}
                        </h6>
                    </td>
                    <td>
                        <h6>

                            {{ $review->vote }}
                        </h6>
                    </td>
                    <td>
                        <h6>
                            {{ $review->review }}
                        </h6>
                    </td>

                    <td>
                        <h6>{{ $review->updated_at }}</h6>
                    </td>
                    <td>
                        <h6>{{ $review->created_at }}</h6>
                    </td>
                    <td>
                        <h6>{{ $review->deleted_at }}</h6>
                    </td>
                    <td>
                        <a href="{{ route('reviews.show', $review->id) }}"><button class="btn btn-success">
                                <img src="{{ Vite::asset('resources/icons/view-show.svg') }}" alt="show" />
                            </button></a>

                        @can('update', $review)
                            <a href="{{ route('reviews.edit', $review->id) }}">
                                <button class="btn btn-warning">
                                    <img src="{{ Vite::asset('resources/icons/pencil2.svg') }}" alt="edit" />
                                </button>
                            </a>
                        @endcan
                        @can('delete', $review)
                            <button data-bs-toggle="modal" class="btn bg-secondary text-white"
                                data-bs-target="#deleteReviewModal_{{ $review->id }}"
                                data-action="{{ route('reviews.destroy', $review->id) }}">
                                <img src="{{ Vite::asset('resources/icons/bin.svg') }}" alt="delete" />
                            </button>
                        @endcan
                    </td>
                </tr>
            </tbody>

            <!-- Delete review Modal -->
            <div class="modal fade" id="deleteReviewModal_{{ $review->id }}" data-backdrop="static" tabindex="-1"
                review="dialog" aria-labelledby="deleteReviewModalLabel" aria-hidden="true">
                <div class="modal-dialog" review="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteReviewModalLabel">This action is irreversible.</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <input id="id" name="$review->id" hidden value="">
                                <h5 class="text-center">Are you sure you want to delete this review?</h5>
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
        {{ $reviews->withQueryString()->links() }}
    </div>
@endsection
