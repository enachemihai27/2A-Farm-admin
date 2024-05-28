<?php


namespace App\Services;

use App\Models\Job;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class JobService
{

    public function getAll(Request $request)
    {

        $jobs = null;
        $searchName = $request->input('searchName');
        $perPage = $request->input('per_page', 5);

        try {
            $jobs = Job::query()
                ->when($searchName, function ($query, $searchName) {
                    return $query->where('positions_of_employment.name', 'like', '%' . $searchName . '%');
                })
                ->paginate($perPage);
        }catch (QueryException $e){
            session()->flash('error', 'Unable to load records.' . $e);
        }
        return $jobs;
    }




    public function validate(Request $request, $job)
    {
        $request->validate([
            'name' => ['required', 'max:256', 'unique:positions_of_employment,name'],
            'description' => 'required'
        ]);

        $job->name = $request->name;
        $job->description = $request->description;

    }

}
