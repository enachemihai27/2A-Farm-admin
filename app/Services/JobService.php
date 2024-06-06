<?php


namespace App\Services;

use App\Models\History;
use App\Models\Job;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class JobService
{

    public function getAll(Request $request, bool $forApi)
    {

        $jobs = null;
        $searchName = $request->input('searchName');
        $perPage = $request->input('per_page', 5);

        try {
            $jobs = Job::query()
                ->when($forApi, function ($query) {
                    return $query->where('status', 1);
                })
                ->when($searchName, function ($query, $searchName) {
                    return $query->where('positions_of_employment.name', 'like', '%' . $searchName . '%');
                })
                ->paginate($perPage);
        } catch (QueryException $e) {
            session()->flash('error', 'Unable to load records.' . $e);
        }
        return $jobs;
    }


    public function validate(Request $request, $job)
    {
        $request->validate([
            'name' => ['required', 'max:256'],
            'description' => 'required',
            'status' => 'required'
        ]);

        if (empty($job->name)) {
            $request->validate([
                'name' => ['unique:positions_of_employment,name']
            ]);
        }

        $job->name = $request->name;
        $job->description = $request->description;
        $job->status = $request->status;

    }

    public function history(Request $request)
    {


        $searchOldData = $request->input('searchOldData');
        $searchNewData = $request->input('searchNewData');
        $perPage = $request->input('per_page', 10);


        $rows = History::query()

            ->when($searchOldData, function ($query, $searchOldData) {
                return $query->where('positions_of_employment_table_history.old_data', 'like', '%' . $searchOldData . '%');
            })

            ->when($searchNewData, function ($query, $searchNewData) {
                return $query->where('positions_of_employment_table_history.new_data', 'like', '%' . $searchNewData . '%');
            })

            ->select('action', 'old_data', 'new_data', 'created_at')->orderByDesc('id')->paginate($perPage);

        $rows->getCollection()->transform(function ($row) {

            $oldData = json_decode($row->old_data, true);
            $newData = json_decode($row->new_data, true);

            $row->old_data = $this->formatData($oldData);
            $row->new_data = $this->formatData($newData);

            return $row;
        });


        return $rows;
    }


    private function formatData(?array $data)
    {

        if ($data === null) {
            return '';
        }
        foreach (['id', 'updated_at', 'created_at'] as $keyToRemove) {
            if (array_key_exists($keyToRemove, $data)) {
                unset($data[$keyToRemove]);
            }
        }
        $formattedData = '';
        foreach ($data as $key => $value) {
            $formattedData .= ucfirst($key) . ': ' . $value . PHP_EOL;
        }

        return $formattedData;
    }

}
