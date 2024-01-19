<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNatureRequest;
use App\Http\Requests\UpdateNatureRequest;
use App\Models\Nature;
use App\Models\User;


class NatureController extends Controller
{
    public function __construct(
        protected Nature $nature
    ) {
        // $this->middleware('auth');
        // $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Nature::class);

        $natures = Nature::orderBy('name', 'ASC')->paginate(5);
        if ($natures->isEmpty()) {
            abort(404);
        }
        return view('options.index',  ['options' => $natures, 'titleIndex' => 'natures', 'index' => 'nature']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Nature::class);

        return view('options.create',  ['titleIndex' => 'natures', 'index' => 'nature']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNatureRequest $request)
    {
        $this->authorize('create', Nature::class);

        $data = $request->except('_token');
        $nature = Nature::create($data);
        return redirect()->route('natures.show', ['nature' => $nature])->with('success', ['id' => $nature->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Nature $nature)
    {
        $this->authorize('view', [Nature::class, $nature]);

        return view('options.show', ['option' => $nature, 'titleIndex' => 'natures', 'index' => 'nature']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nature $nature)
    {
        $this->authorize('update', [Nature::class, $nature]);

        return view('options.edit',  ['option' => $nature, 'titleIndex' => 'natures', 'index' => 'nature']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNatureRequest $request, Nature $nature)
    {
        $this->authorize('update', [Nature::class, $nature]);

        $data = $request->except('_token');
        $nature->update($data);

        return redirect()->route('natures.show', ['nature' => $nature])->with('success', ['id' => $nature->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nature $nature)
    {
        $this->authorize('delete', [Nature::class, $nature]);

        $nature->delete();
        return redirect()->route('natures.index')->with('success', 'Nature deleted successfully.');
    }
}
