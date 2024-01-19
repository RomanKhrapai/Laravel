<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Type;
use App\Models\User;

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
        $this->authorize('viewAny', Type::class);
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
        $this->authorize('create', Type::class);
        return view('options.create',  ['titleIndex' => 'types', 'index' => 'type']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $this->authorize('create', Type::class);
        $data = $request->except('_token');
        $type = Type::create($data);
        return redirect()->route('types.show', ['type' => $type])->with('success', ['id' => $type->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        $this->authorize('view', [Type::class, $type]);

        return view('options.show', ['option' => $type, 'titleIndex' => 'types', 'index' => 'type']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        $this->authorize('update', [Type::class, $type]);
        return view('options.edit',  ['option' => $type, 'titleIndex' => 'types', 'index' => 'type']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $this->authorize('update', [Type::class, $type]);
        $data = $request->except('_token');
        $type->update($data);

        return redirect()->route('types.show', ['type' => $type])->with('success', ['id' => $type->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $this->authorize('delete', [Type::class, $type]);
        $type->delete();
        return redirect()->route('types.index')->with('success', 'type deleted successfully.');
    }
}
