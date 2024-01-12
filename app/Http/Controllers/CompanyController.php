<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\User;

class CompanyController extends Controller
{
    public function __construct(
        protected Company $company
    ) {
        // $this->middleware('auth');
        // $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(5);
        return view('companies.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('companies.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {

        $data = $request->except('_token');

        $company = Company::create($data);

        return redirect()->route('companies.show', ['company' => $company])->with('success', ['id' => $company->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('companies.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $users = User::all();
        return view('companies.edit', ['company' => $company, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $data = $request->except('_token');

        $company->update($data);

        return redirect()->route('companies.show', ['company' => $company]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'User deleted successfully.');
    }
}
