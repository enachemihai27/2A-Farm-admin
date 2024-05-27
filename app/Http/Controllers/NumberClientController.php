<?php

namespace App\Http\Controllers;

use App\Helpers\ImageUploadHelper;
use App\Models\NumberClient;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class NumberClientController extends Controller
{
    use ImageUploadHelper;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $numbers = NumberClient::all();

        if ($request->expectsJson()) {
            return response()->json($numbers);
        } else {
            return view('numbers.index', compact('numbers'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('numbers.create');
    }


    public function validateAndUpload(Request $request, $number)
    {
        $request->validate([
            'number' => ['required', 'integer'],
            'text' => ['required']
        ]);


        if ($request->hasFile('icon')) {
            $request->validate([
                'icon' => ['required', 'max:2028', 'image']
            ]);
            $path = $this->uploadImage($request, 'icon', 'uploads');
            $number->icon = $path;
        }
        $number->client_id = 1;
        $number->number = $request->number;
        $number->text = $request->text;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $number = new NumberClient();
        $this->validateAndUpload($request, $number);
        try {
            $number->save();
            return redirect()->route('numbers.index')->with('success', 'Record saved successfully.');
        } catch (QueryException $e) {
            return redirect()->route('numbers.create')->withErrors(['error' => 'Unable to save record. ' . $e->getMessage()]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $number = null;
        try {
            $number = NumberClient::findOrFail($id);
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
            $number = NumberClient::findOrFail($id);
            $this->validateAndUpload($request, $number);
            $number->save();
            return redirect()->route('numbers.index')->with('success', 'Record saved successfully.');
        } catch (ModelNotFoundException|QueryException $e) {
            return redirect()->route('numbers.create')->withErrors(['error' => 'Unable to save record. ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
/*        try {
            $number = NumberClient::findOrFail($id);
            File::delete(public_path($number->icon));
            $number->delete();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'Record not found or could not be deleted.' . $e]);
        }
        return redirect()->back()->with('success', 'Record deleted successfully.');*/
        return redirect()->route('numbers.index')->withErrors(['error' => 'Delete not allowed!']);
    }
}
