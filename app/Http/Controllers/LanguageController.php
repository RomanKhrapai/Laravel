<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;

class LanguageController extends Controller
{
    public function __construct(
        protected Language $language
    ) {
        // $this->middleware('auth');
        // $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::orderBy('name', 'ASC')->paginate(5);
        if ($languages->isEmpty()) {
            abort(404);
        }
        return view('options.index',  ['options' => $languages, 'titleIndex' => 'languages', 'index' => 'language']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('options.create',  ['titleIndex' => 'languages', 'index' => 'language']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLanguageRequest $request)
    {
        $data = $request->except('_token');
        $language = Language::create($data);
        return redirect()->route('languages.show', ['language' => $language])->with('success', ['id' => $language->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $language = Language::findOrFail($id);
        return view('options.show', ['option' => $language, 'titleIndex' => 'languages', 'index' => 'language']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $language = Language::findOrFail($id);
        return view('options.edit',  ['option' => $language, 'titleIndex' => 'languages', 'index' => 'language']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanguageRequest $request, language $language)
    {
        $data = $request->except('_token');
        $language->update($data);

        return redirect()->route('languages.show', ['language' => $language])->with('success', ['id' => $language->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $language = Language::findOrFail($id);
        $language->delete();
        return redirect()->route('languages.index')->with('success', 'language deleted successfully.');
    }
}
