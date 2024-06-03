<?php

namespace App\Http\Controllers;


use App\Models\Department;
use App\Models\MapData;
use App\Models\Person;
use App\Services\PersonService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class PersonController extends Controller
{

    protected PersonService $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->personService->index();
    }

    public function privateIndex(Request $request)
    {
        try {
            $persons = $this->personService->getAll($request);

            return view('persons.index', compact('persons'));
        } catch (QueryException $e) {
            session()->flash('error', 'Unable to load records.' . $e);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $symbols = MapData::all();
        $departments = Department::all();
        return view('persons.create', compact('symbols', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'department' => ['required', 'exists:departments,department'],
            'email' => ['required', 'email'],
            'symbol' => ['required', 'exists:map_data,symbol'],
            'prefix' => ['required'],
            'phone' => ['required', 'regex:/^[0-9]{10}$/']
        ]);

        $person = new Person();

        $person->name = $request->name;
        $person->department = $request->department;
        $person->email = $request->email;
        $person->symbol = $request->symbol;
        $person->prefix = $request->prefix;
        $person->phone = $request->phone;
        try {

            $person->save();

        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to create record. ' . $e->getMessage()]);
        }
        return redirect()->route('persons.privateIndex');


    }

    /**
     * Display the specified resource.
     */
    public
    function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(string $id)
    {
        try {
            $person = Person::findOrFail($id);
            $person->delete();
            session()->flash('success', 'Person deleted successfully.');
        } catch (ModelNotFoundException|QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to delete record. ' . $e->getMessage()]);
        }

        return redirect()->back();
    }
}
