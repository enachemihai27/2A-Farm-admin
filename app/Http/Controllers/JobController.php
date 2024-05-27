<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Services\JobService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
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
        try {
            $jobs = $this->jobService->getAll($request);
        }catch (QueryException $e){
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
        return view('jobs.create');
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $job = new Job();
            $this->jobService->validate($request, $job);
            $job->save();
            session()->flash('success', 'Jobs created successfully.');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to create record. ' . $e->getMessage()]);
        }
        return redirect()->route('jobs.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $job = null;
        try {
            $job = Job::findOrFail($id);
        } catch (ModelNotFoundException $e) {
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
            $this->jobService->validate($request, $job);
            $job->save();
            session()->flash('success', 'Job updated successfully.');
        } catch (ModelNotFoundException|QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to update record. ' . $e->getMessage()]);
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
        } catch (ModelNotFoundException|QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Unable to delete record. ' . $e->getMessage()]);
        }

        return redirect()->route('jobs.index');
    }
}
