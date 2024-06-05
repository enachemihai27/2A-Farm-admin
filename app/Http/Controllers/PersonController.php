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
        try {
            $symbols = MapData::all();
            $departments = Department::all();
            return view('persons.create', compact('symbols', 'departments'));
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to find records. ' . $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $newPerson = new Person();
            $person = $this->personService->validateAndAdd($request, $newPerson);
            $person->save();
            session()->flash('success', 'Reprezentant creat cu succes.');
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
        $person = null;
        $departments = null;
        $judete = null;
        try {
            $person = Person::findOrFail($id);
            $departments = Department::all();
            $judete = MapData::all();
        } catch (ModelNotFoundException $e) {
            session()->flash('error', 'Record not found.' . $e);
        }
        return view('persons.edit', compact('person', 'departments', 'judete'));
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request, string $id)
    {
        try {
            $editPerson = Person::findOrFail($id);
            $person = $this->personService->validateAndAdd($request, $editPerson);
            $person->save();
            session()->flash('success', 'Reprezentant editat cu succes.');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to create record. ' . $e->getMessage()]);
        }
        return redirect()->route('persons.privateIndex');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $person = Person::findOrFail($id);
            $person->delete();
            session()->flash('success', 'Reprezentant sters cu success.');
        } catch (ModelNotFoundException|QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to delete record. ' . $e->getMessage()]);
        }

        return redirect()->back();
    }
}
