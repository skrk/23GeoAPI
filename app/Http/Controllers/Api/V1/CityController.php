<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\City;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCityRequest;
use App\Http\Requests\V1\UpdateCityRequest;
use App\Http\Resources\V1\CityResource;
use App\Http\Resources\V1\CityCollection;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Country $country)
    {
        return new CityCollection($country->city);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityRequest $request, Country $country)
    {
        return new CityResource($country->city()->create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return new CityResource($city);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCityRequest  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        return $city->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        return City::destroy($city->id);
    }
}
