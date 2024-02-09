<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class ApiAreaController extends Controller
{
    public function search(Request $request)
    {
        $limit = $request->query('limit', 20);
        $name = $request->query('name');

        $areas = Area::query()
            ->byName($name)
            ->take($limit)
            ->get(['id', 'name'])
            ->toArray();

        return response()->json($areas);
    }

    public function byId(Area $area)
    {
        return response()->json(
            ['id' => $area->id, 'name' => $area->name,]
        );
    }
}
