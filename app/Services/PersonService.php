<?php


namespace App\Services;

use App\Models\MapData;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class PersonService
{


    public function index()
    {
        try {
            $representatives = MapData::leftJoin('representative_people', 'map_data.symbol', '=', 'representative_people.symbol')
                ->select('map_data.symbol', 'representative_people.name', 'representative_people.department', 'representative_people.email', 'representative_people.prefix', 'representative_people.phone')
                ->get();

            if ($representatives->isEmpty()) {
                return response()->json(['msg' => 'No records found'], 404);
            }

            $groupedRepresentatives = $this->groupRepresentatives($representatives);

            return response()->json($groupedRepresentatives);
        } catch (QueryException $e) {
            return response()->json(['msg' => 'Query error', 'error' => $e->getMessage()], 500);
        }
    }




    private function groupRepresentatives($representatives)
    {
        $grouped = [];

        foreach ($representatives as $representative) {
            $symbol = $representative->symbol;
            if (!isset($grouped[$symbol])) {
                $grouped[$symbol] = [];
            }

            if (!is_null($representative->name)) {
                $grouped[$symbol][] = [
                    'name' => $representative->name,
                    'department' => $representative->department,
                    'email' => $representative->email,
                    'prefix' => $representative->prefix,
                    'phone' => $representative->phone
                ];
            }
        }

        $result = [];
        foreach ($grouped as $symbol => $persons) {
            $result[] = [
                'symbol' => $symbol,
                'persons' => $persons
            ];
        }

        return $result;
    }

    public function getAll(Request $request)
    {

        $persons = null;
        $searchName = $request->input('searchName');
        $searchJudet = $request->input('searchJudet');
        $perPage = $request->input('per_page', 20);

        try {

            $persons = Person::query()
                ->leftJoin('map_data', 'representative_people.symbol', '=', 'map_data.symbol')
                ->select('representative_people.*', 'map_data.title as map_data_title')
                ->when($searchName, function ($query, $searchName) {
                    return $query->where('representative_people.name', 'like', '%' . $searchName . '%');
                })
                ->when($searchJudet, function ($query, $searchJudet) {
                    return $query->where('map_data.title', 'like', '%' . $searchJudet . '%');
                })
                ->paginate($perPage);


        }catch (QueryException $e){
            session()->flash('error', 'Unable to load records.' . $e);
        }
        return $persons;
    }

    public function validateAndAdd(Request $request, $person){
        $request->validate([
            'name' => ['required'],
            'department' => ['required', 'exists:departments,department'],
            'email' => ['required', 'email'],
            'symbol' => ['required', 'exists:map_data,symbol'],
            'prefix' => ['required'],
            'phone' => ['required']
        ]);


        $person->name = $request->name;
        $person->department = $request->department;
        $person->email = $request->email;
        $person->symbol = $request->symbol;
        $person->prefix = $request->prefix;
        $person->phone = $request->phone;

        return $person;
    }

}
