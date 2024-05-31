<?php

namespace App\Http\Controllers;

use App\Models\MapData;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MapDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $map_data = MapData::all();
            
            $map_data->transform(function ($item) {
                if (is_null($item->pathColor)) {
                    $item->makeHidden('pathColor');
                }
                return $item;
            });

            $map_data->makeHidden(['primary_key', 'created_at', 'updated_at']);
            return response()->json($map_data);
        } catch (QueryException|ModelNotFoundException $e) {
            return response()->json(['msg' => 'Record not found'], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $map_data = MapData::findOrFail($id);
            $map_data->makeHidden(['primary_key', 'created_at', 'updated_at']);
            return response()->json($map_data);
        } catch (QueryException|ModelNotFoundException $e) {
            return response()->json(['msg' => 'Record not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
