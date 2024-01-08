<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{

    public function __construct(
        protected Category $category
    ) {
        // $this->middleware('auth');
        // $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::orderBy('name', 'ASC')->paginate(5);
        if ($category->isEmpty()) {
            abort(404);
        }
        return view('options.index',  ['options' => $category, 'titleIndex' => 'categories', 'index' => 'categories']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('options.create', ['titleIndex' => 'categories', 'index' => 'categories']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->except('_token');
        $category = Category::create($data);
        return redirect()->route('categories.show', ['category' => $category])->with('success', ['id' => $category->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('options.show', ['option' => $category, 'titleIndex' => 'categories', 'index' => 'categories']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('options.edit',  ['option' => $category, 'titleIndex' => 'categories', 'index' => 'category']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->except('_token');
        $category->update($data);

        return redirect()->route('categories.show', ['category' => $category])->with('success', ['id' => $category->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'category deleted successfully.');
    }
}
