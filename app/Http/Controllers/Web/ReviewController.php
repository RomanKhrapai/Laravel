<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Filters\WebReviewFilter;
use App\Http\Requests\Review\WebFilterRequest;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;

class ReviewController extends Controller
{

    public function __construct(
        protected Review $review
    ) {
        $this->authorizeResource(Review::class, 'review');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(WebFilterRequest $request)
    {
        $sortArray = [['id', 'id'], ['parent id', 'parent_id'], ['user id', 'user_id'], ['company id', 'company_id'], ['evaluated user id', 'evaluated_user_id'], ['evaluated company id', 'evaluated_company_id'], ['vote', 'vote'], ['review', 'review'], ['updated_at', 'updated_at'], ['created_at', 'created_at'], ['deleted at', 'deleted_at']];

        $filterFiels = ['id', 'parent_id', 'user_id', 'company_id', 'evaluated_user_id', 'evaluated_company_id', 'vote', 'review'];

        $data = $request->validated();

        $filter = app()->make(WebReviewFilter::class, ['queryParams' => array_filter($data)]);

        $reviews = Review::filter($filter)->orderBy($data['sort_by'] ?? 'created_at',  $data['sort_order'] ?? 'asc')->paginate(5);

        return view('reviews.index', ['reviews' => $reviews, 'sortArray' => $sortArray, 'filterFiels' => $filterFiels]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
