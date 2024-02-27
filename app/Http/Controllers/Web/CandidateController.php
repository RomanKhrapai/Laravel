<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use App\Models\Candidate;
use App\Models\Area;
use App\Models\Company;
use App\Models\Nature;
use App\Models\Type;
use App\Models\User;
use App\Models\Profession;
use App\Models\Skill;

class CandidateController extends Controller
{
    public function __construct(
        protected Candidate $Candidate
    ) {
        // $this->middleware('auth');
        // $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Candidate::class);

        $candidates = Candidate::paginate(5);

        return view('candidates.index', ['candidates' => $candidates]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Candidate::class);

        $areas = Area::all();
        $natures = Nature::all();
        $types = Type::all();
        $users = User::all();
        $professions = Profession::all();
        $skills = Skill::all();

        return view('candidates.create', [
            'areas' => $areas,
            'natures' => $natures,
            'types' => $types,
            'users' => $users,
            'professions' => $professions,
            'skills' => $skills,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCandidateRequest $request)
    {
        $this->authorize('create', Candidate::class);

        $max_salary = $request->input('max_salary');
        $skills = $request->input('skills');
        $types = $request->input('types');
        $data = $request->except('_token', 'max_salary', 'skills', 'types');

        if (!empty($max_salary)) {
            $data['max_salary'] = $max_salary;
        }

        $candidate = Candidate::create($data);
        $candidate->skills()->sync($skills);
        $candidate->types()->sync($types);
        return redirect()->route('candidates.show', ['candidate' => $candidate])
            ->with('success', ['id' => $candidate->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        $this->authorize('view', [Candidate::class, $candidate]);
        return view('candidates.show', ['candidate' => $candidate]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        $this->authorize('update', [Candidate::class, $candidate]);
        $areas = Area::all();
        $natures = Nature::all();
        $types = Type::all();
        $users = User::all();
        $professions = Profession::all();
        $skills = Skill::all();

        return view('candidates.edit', [
            'candidate' => $candidate,
            'areas' => $areas,
            'natures' => $natures,
            'types' => $types,
            'users' => $users,
            'professions' => $professions,
            'skills' => $skills,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCandidateRequest $request, Candidate $candidate)
    {
        $this->authorize('update', [Candidate::class, $candidate]);

        $max_salary = $request->input('max_salary');
        $skills = $request->input('skills');
        $types = $request->input('types');
        $data = $request->except('_token', 'max_salary', 'skills', 'types');


        if (!empty($max_salary)) {
            $data['max_salary'] = $max_salary;
        }

        $candidate->update($data);
        $candidate->skills()->sync($skills);
        $candidate->types()->sync($types);

        return redirect()->route('candidates.show', ['candidate' => $candidate])
            ->with('success', ['id' => $candidate->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        $this->authorize('delete', [Candidate::class, $candidate]);
        // $candidate->types()->detach();
        // $candidate->skills()->detach();
        $candidate->softDeletes();

        return redirect()->route('candidates.index')->with('success', 'User deleted successfully.');
    }
}
