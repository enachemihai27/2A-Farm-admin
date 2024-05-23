<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchName = $request->input('searchName');
        $searchCompanyName = $request->input('searchCompanyName');

        $jobs = Job::query()
            ->leftJoin('clients', 'position_of_employment.client_id', '=', 'clients.id')
            ->select('position_of_employment.*', 'clients.name as client_name')
            ->when($searchName, function ($query, $searchName) {
                return $query->where('position_of_employment.name', 'like', '%' . $searchName . '%');
            })
            ->when($searchCompanyName, function ($query, $searchCompanyName) {
                return $query->where('clients.name', 'like', '%' . $searchCompanyName . '%');
            })
            ->paginate(5);


        if($request->expectsJson()){
            return response()->json($jobs);
        }else {
            return view('jobs.index', compact('jobs'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Client::all();
        return view('jobs.create', compact('companies'));
    }

    public function validateAndSave(Request $request, $job){
        $request->validate([
            'name' => ['required', 'max:256'],
            'description' => 'required'
        ]);

        $job->name = $request->name;
        $job->client_id = 1;
        $job->description = $request->description;

        $job->save();

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $job = new Job();
        $this->validateAndSave($request, $job);

        return redirect()->route('jobs.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job = Job::findOrFail($id);

        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $job = Job::findOrFail($id);

        $this->validateAndSave($request, $job);

        return redirect()->route('jobs.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Job::findOrFail($id);

        $job->delete();

        return redirect()->route('jobs.index');
    }
}
