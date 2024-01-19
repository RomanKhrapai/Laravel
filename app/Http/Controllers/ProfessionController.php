<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfessionRequest;
use App\Http\Requests\UpdateProfessionRequest;
use App\Models\Profession;

class ProfessionController extends Controller
{

    public function __construct(
        protected Profession $profession
    ) {
        $this->authorizeResource(Profession::class, 'profession');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profession = Profession::orderBy('name', 'ASC')->paginate(5);
        if ($profession->isEmpty()) {
            abort(404);
        }
        return view('options.index',  ['options' => $profession, 'titleIndex' => 'professions', 'index' => 'professions']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('options.create', ['titleIndex' => 'professions', 'index' => 'professions']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfessionRequest $request)
    {
        $data = $request->except('_token');
        $profession = Profession::create($data);
        return redirect()->route('professions.show', ['profession' => $profession])->with('success', ['id' => $profession->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Profession $profession)
    {
        return view('options.show', ['option' => $profession, 'titleIndex' => 'professions', 'index' => 'professions']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profession $profession)
    {
        return view('options.edit',  ['option' => $profession, 'titleIndex' => 'professions', 'index' => 'profession']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfessionRequest $request, Profession $profession)
    {
        $data = $request->except('_token');
        $profession->update($data);

        return redirect()->route('professions.show', ['profession' => $profession])->with('success', ['id' => $profession->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profession $profession)
    {
        $profession->delete();
        return redirect()->route('professions.index')->with('success', 'profession deleted successfully.');
    }
}
