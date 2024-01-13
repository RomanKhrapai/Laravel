<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Models\Area;
use App\Models\User;

class AreaController extends Controller
{

    public function __construct(
        protected Area $area
    ) {
        // $this->middleware('auth');
        // $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Area::class);
        $areas = Area::orderBy('name', 'ASC')->paginate(5);
        if ($areas->isEmpty()) {
            abort(404);
        }
        return view('options.index',  ['options' => $areas, 'titleIndex' => 'areas', 'index' => 'area']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Area::class);

        return view('options.create',  ['titleIndex' => 'areas', 'index' => 'area']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAreaRequest $request)
    {
        $this->authorize('create', Area::class);

        $data = $request->except('_token');
        $area = Area::create($data);
        return redirect()->route('areas.show', ['area' => $area])->with('success', ['id' => $area->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        $this->authorize('view', User::class, Area::class);

        return view('options.show', ['option' => $area, 'titleIndex' => 'areas', 'index' => 'area']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        $this->authorize('update', User::class, Area::class);

        return view('options.edit',  ['option' => $area, 'titleIndex' => 'areas', 'index' => 'area']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        $this->authorize('update', User::class, Area::class);

        $data = $request->except('_token');
        $area->update($data);

        return redirect()->route('areas.show', ['area' => $area])->with('success', ['id' => $area->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        $this->authorize('delete', User::class, Area::class);

        $area->delete();
        return redirect()->route('areas.index')->with('success', 'Area deleted successfully.');
    }
}
