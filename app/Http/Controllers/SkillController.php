<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\Category;
use App\Models\Skill;

class SkillController extends Controller
{
    public function __construct(
        protected Skill $skill
    ) {
        // $this->middleware('auth');
        // $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::orderBy('name', 'ASC')->paginate(5);
        if ($skills->isEmpty()) {
            abort(404);
        }
        return view('skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();

        return view('skills.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSkillRequest $request)
    {
        $data = $request->except('_token');

        $skill = Skill::create($data);

        return redirect()->route('skills.show', ['skill' => $skill])->with('success', ['id' => $skill->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        // $user = User::findOrFail($id);
        return view('skills.show', compact('skill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {

        $categories = Category::all();
        return view('skills.edit', ['skill' => $skill, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSkillRequest $request, Skill $skill)
    {

        $data = $request->except('_token');
        $skill->update($data);

        return redirect()->route('skills.show', ['skill' => $skill]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {

        $skill->delete();

        return redirect()->route('skills.index')->with('success', 'Skill deleted successfully.');
    }
}
