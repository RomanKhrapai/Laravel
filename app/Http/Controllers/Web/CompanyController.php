<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

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
        $this->authorize('viewAny', Company::class);

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
        $this->authorize('create', Company::class);
        $imageUrl = $request->input('image');
        $data = $request->except('_token', 'img', "image");

        if ($imageUrl && !File::exists(storage_path('app/public/' . $imageUrl))) {
            throw ValidationException::withMessages([
                'image' => 'Problem file.',
            ]);
        } elseif ($imageUrl) {
            $uniqueName = Str::uuid()->toString();
            $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
            $newPath = 'images/companies/avatars/' . $uniqueName . '.' . $extension;
            Storage::disk('public')->move($imageUrl, $newPath);
            $data['image'] = $newPath;
        }

        $company = Company::create($data);

        return redirect()->route('companies.show', ['company' => $company])->with('success', ['id' => $company->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $this->authorize('view', [Company::class, $company]);

        return view('companies.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $this->authorize('update', [Company::class, $company]);

        $users = User::all();
        return view('companies.edit', ['company' => $company, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $this->authorize('update', [Company::class, $company]);
        $imageUrl = $request->input('image');

        $data = $request->except('_token', 'img', "image");

        if ($imageUrl && !File::exists(storage_path('app/public/' . $imageUrl))) {
            throw ValidationException::withMessages([
                'image' => 'Problem file.',
            ]);
        } elseif ($imageUrl && $imageUrl !== $company->image) {
            $uniqueName = Str::uuid()->toString();
            $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
            $newPath = 'images/companies/avatars/' . $uniqueName . '.' . $extension;
            Storage::disk('public')->move($imageUrl, $newPath);
            $data['image'] = $newPath;

            // $newUrl = str_replace("/storage/", "", $company->image);
            if (isset($company->image) && Storage::exists('public/' . $company->image)) {
                Storage::delete('public/' .  $company->image);
            }
        } else {
            $data['image'] = $imageUrl;

            // $newUrl = str_replace("/storage/", "", $company->image);
            if (!$imageUrl && isset($company->image) && Storage::exists('public/' . $company->image)) {
                Storage::delete('public/' . $company->image);
            }
        }

        $company->update($data);

        return redirect()->route('companies.show', ['company' => $company]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $this->authorize('delete', [Company::class, $company]);

        $company->softDeletes();

        return redirect()->route('companies.index')->with('success', 'User deleted successfully.');
    }
}
