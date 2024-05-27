<?php


namespace App\Services;

use Illuminate\Http\Request;

class JobService
{
    public function validateAndSave(Request $request, $job)
    {
        $request->validate([
            'name' => ['required', 'max:256', 'unique:position_of_employment,name'],
            'description' => 'required'
        ]);

        $job->name = $request->name;
        $job->client_id = 1;
        $job->description = $request->description;

        $job->save();
    }

}
