<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Job;
use App\Services\JobService;
use Illuminate\Http\Request;
use Mockery\Exception;

class JobController extends Controller
{

    protected JobService $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jobs = null;
        $searchName = $request->input('searchName');
        $searchCompanyName = $request->input('searchCompanyName');

        try {
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
        }catch (Exception $e){
            session()->flash('error', 'Unable to load records.' . $e);
        }

        if ($request->expectsJson()) {
            return response()->json($jobs);
        } else {
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




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $job = new Job();
            $this->jobService->validateAndSave($request, $job);
            session()->flash('success', 'Jobs created successfully.');
        } catch (Exception $e) {
            session()->flash('error', 'Unable to created record.' . $e);
        }
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
        $job = null;
        try {
            $job = Job::findOrFail($id);
        } catch (Exception $e) {
            session()->flash('error', 'Record not found.' . $e);
        }
        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $job = Job::findOrFail($id);
            $this->jobService->validateAndSave($request, $job);
            session()->flash('success', 'Job updated successfully.');
        } catch (Exception $e) {
            session()->flash('error', 'Record not found or could not be updated.' . $e);
        }
        return redirect()->route('jobs.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $job = Job::findOrFail($id);
            $job->delete();
            session()->flash('success', 'Job deleted successfully.');
        } catch (Exception $e) {
            session()->flash('error', 'Record not found or could not be deleted.' . $e);
        }

        return redirect()->route('jobs.index');
    }
}
