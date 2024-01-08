<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Type;

class TypeController extends Controller
{
    public function __construct(
        protected Type $type
    ) {
        // $this->middleware('auth');
        // $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::orderBy('name', 'ASC')->paginate(5);
        if ($types->isEmpty()) {
            abort(404);
        }
        return view('options.index',  ['options' => $types, 'titleIndex' => 'types', 'index' => 'type']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('options.create',  ['titleIndex' => 'types', 'index' => 'type']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $data = $request->except('_token');
        $type = Type::create($data);
        return redirect()->route('types.show', ['type' => $type])->with('success', ['id' => $type->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $type = Type::findOrFail($id);
        return view('options.show', ['option' => $type, 'titleIndex' => 'types', 'index' => 'type']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $type = Type::findOrFail($id);
        return view('options.edit',  ['option' => $type, 'titleIndex' => 'types', 'index' => 'type']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $data = $request->except('_token');
        $type->update($data);

        return redirect()->route('types.show', ['type' => $type])->with('success', ['id' => $type->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = Type::findOrFail($id);
        $type->delete();
        return redirect()->route('types.index')->with('success', 'type deleted successfully.');
    }
}
