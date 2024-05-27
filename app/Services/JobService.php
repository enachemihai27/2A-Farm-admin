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
        $searchCompanyName = $request->input('searchCompanyName');
        $perPage = $request->input('per_page', 5);

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
                ->paginate($perPage);
        }catch (QueryException $e){
            session()->flash('error', 'Unable to load records.' . $e);
        }
        return $jobs;
    }




    public function validate(Request $request, $job)
    {
        $request->validate([
            'name' => ['required', 'max:256', 'unique:position_of_employment,name'],
            'description' => 'required'
        ]);

        $job->name = $request->name;
        $job->client_id = 1;
        $job->description = $request->description;

    }

}
