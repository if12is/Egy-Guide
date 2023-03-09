<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\RoadMap;
use Illuminate\Http\Request;
use WisdomDiala\Countrypkg\Models\State;

class RoadMapController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        // dd($request->description);

        $RoadMap = RoadMap::create([
            'name' => $request->name,
            'state_id' => $request->state_id,
            'description' => $request->description,
        ]);

        return back()->with('success', 'road map created successfully');
    }
    public function showCityRoadMaps($cityId)
    {

        $city = State::where('id', '=', $cityId)->get();
        // dd($city[0]->id);
        $RoadMaps = RoadMap::where('state_id', '=', $cityId)->orderBy('id', 'desc')->paginate(5);
        return view('front.roadMap', ['RoadMaps' => $RoadMaps, 'city' => $city]);
    }
}
