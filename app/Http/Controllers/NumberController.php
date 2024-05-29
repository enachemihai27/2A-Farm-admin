<?php

namespace App\Http\Controllers;

use App\Helpers\ImageUploadHelper;
use App\Models\Number;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class NumberController extends Controller
{
    use ImageUploadHelper;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $numbers = Number::all();
            if ($request->expectsJson()) {
                return response()->json($numbers);
            }
        } catch (QueryException $e) {
            return response()->json('error', 'Unable to load records.' . $e);
        }
    }


    public function privateIndex(Request $request)
    {
        try {
            $numbers = Number::all();
            return view('numbers.index', compact('numbers'));
        } catch (QueryException $e) {
            session()->flash('error', 'Unable to load records.' . $e);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Number::all()->count() < 4) {
            return view('numbers.create');
        }
    }


    public function validateAndUpload(Request $request, $number)
    {
        $request->validate([
            'number' => ['required', 'integer']
        ]);

        $number->number = $request->number;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Number::all()->count() < 4) {
            $number = new Number();
            $this->validateAndUpload($request, $number);
            try {
                $number->save();
                return redirect()->route('numbers.privateIndex')->with('success', 'Record saved successfully.');
            } catch (QueryException $e) {
                return redirect()->route('numbers.create')->withErrors(['error' => 'Unable to save record. ' . $e->getMessage()]);
            }
        }
        return redirect()->route('numbers.privateIndex');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $number = null;
        try {
            $number = Number::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            session()->flash('error', 'Record not found.' . $e);
        }
        return view('numbers.edit', compact('number'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $number = Number::findOrFail($id);
            $this->validateAndUpload($request, $number);
            $number->save();
            return redirect()->route('numbers.privateIndex')->with('success', 'Record saved successfully.');
        } catch (ModelNotFoundException|QueryException $e) {
            return redirect()->route('numbers.create')->withErrors(['error' => 'Unable to save record. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->back()->withErrors(['error' => 'Delete not allowed!']);
    }
}
