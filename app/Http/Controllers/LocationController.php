<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationQuery;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Http\Resources\LocationCollection;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postcode = request()->input('postcode', null);

        $locations = Location::when($postcode, function($query) use ($postcode) {
            // get LocationQuery instance from the postcode or create it
            $location = LocationQuery::findOrCreateByPostcode($postcode);

            // use query builder macro haversine to get distance from location
            return $query->haversine($location->latitude, $location->longitude)
                ->orderBy('distance', 'asc');
        })->get();

        return new LocationCollection($locations);
    }

    public function nearest(Request $request)
    {
        $validated = $request->validate([
            'postcode' => 'required|string',
        ]);

        $postcode = $validated['postcode'];

        $location = Location::when($postcode, function($query) use ($postcode) {
            // get LocationQuery instance from the postcode or create it
            $location = LocationQuery::findOrCreateByPostcode($postcode);

            // use query builder macro haversine to get distance from location
            return $query->haversine($location->latitude, $location->longitude)
                ->orderBy('distance', 'asc');
        })->first();

        return new LocationResource($location);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationRequest $request)
    {
        $validated = $request->validated();

        // get LocationQuery instance from the postcode or create it
        $location = LocationQuery::findOrCreateByPostcode($validated['postcode']);

        $location = Location::create([
            'postcode' => $validated['postcode'],
            'latitude' => $location->latitude,
            'longitude' => $location->longitude,
            'times' => [
                'opening_times' => $validated['opening_times'],
                'closing_times' => $validated['closing_times'],
            ],
        ]);

        return response()->json([
            'data' => $location,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return response()->json([
            'data' => $location,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocationRequest  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        $validated = $request->validated();

        $location->update($validated);

        return response()->json([
            'data' => $location,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return response()->json([], 204);
    }
}
