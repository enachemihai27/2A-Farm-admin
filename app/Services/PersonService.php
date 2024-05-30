<?php


namespace App\Services;

use App\Models\MapData;
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

}
