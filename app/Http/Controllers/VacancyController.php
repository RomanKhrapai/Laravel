<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVacancyRequest;
use App\Http\Requests\UpdateVacancyRequest;
use App\Models\Area;
use App\Models\Company;
use App\Models\Nature;
use App\Models\Type;
use App\Models\Vacancy;
use App\Models\User;
use App\Models\Profession;

class VacancyController extends Controller
{

    public function __construct(
        protected Vacancy $vacancy
    ) {
        // $this->middleware('auth');
        // $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Vacancy::class);

        $vacancies = Vacancy::paginate(5);

        return view('vacancies.index', ['vacancies' => $vacancies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Vacancy::class);

        $areas = Area::all();
        $natures = Nature::all();
        $types = Type::all();
        $companies = Company::all();
        $professions = Profession::all();

        return view('vacancies.create', [
            'areas' => $areas,
            'natures' => $natures,
            'types' => $types,
            'companies' => $companies,
            'professions' => $professions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVacancyRequest $request)
    {
        $this->authorize('create', Vacancy::class);

        $max_salary = $request->input('max_salary');
        $data = $request->except('_token', 'max_salary');

        if (!empty($password)) {
            $data['max_salary'] = $max_salary;
        }

        $vacancy = Vacancy::create($data);

        return redirect()->route('vacancies.show', ['vacancy' => $vacancy])
            ->with('success', ['id' => $vacancy->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vacancy $vacancy)
    {
        $this->authorize('view', User::class, Vacancy::class);
        return view('vacancies.show', ['vacancy' => $vacancy]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacancy $vacancy)
    {
        $this->authorize('update', User::class, Vacancy::class);
        $areas = Area::all();
        $natures = Nature::all();
        $types = Type::all();
        $companies = Company::all();
        $professions = Profession::all();

        return view('vacancies.edit', [
            'vacancy' => $vacancy,
            'areas' => $areas,
            'natures' => $natures,
            'types' => $types,
            'companies' => $companies,
            'professions' => $professions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVacancyRequest $request, Vacancy $vacancy)
    {
        $this->authorize('update', User::class, Vacancy::class);
        $data = $request->except('_token');

        $vacancy->update($data);

        return redirect()->route('vacancies.show', ['vacancy' => $vacancy]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        $this->authorize('delete', User::class, Vacancy::class);
        $vacancy->delete();

        return redirect()->route('vacancy.index')->with('success', 'User deleted successfully.');
    }
}
