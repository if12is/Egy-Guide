<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RoadMap;
use Illuminate\Http\Request;
use WisdomDiala\Countrypkg\Models\State;

class RoadMapController extends Controller
{
    public function showCityRoadMaps($cityId)
    {

        $city = State::where('id', '=', $cityId)->get();

        $RoadMaps = RoadMap::where('state_id', '=', $cityId)->orderBy('id', 'desc')->get();

        return response()->json([
            'message' => 'Get All RoadMap of ' . $city[0]->name,
            'category' => $RoadMaps,
        ], 200);
    }
}
