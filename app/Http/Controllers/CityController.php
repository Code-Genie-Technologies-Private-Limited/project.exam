<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::with('creator')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('dashboard.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request)
    {
        City::create(array_merge(
            $request->validated(),
            ['created_by' => auth()->user()->id]
        ));

        $request->session()->flash('message', 'created successfully.');

        return redirect()->route('cities.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        return view('dashboard.cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        return view('dashboard.cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $city->update($request->validated());
        $request->session()->flash('message', 'updated successfully.');

        return redirect()->route('cities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city, Request $request)
    {
        $city->delete();
        $request->session()->flash('message', 'deleted successfully.');

        return redirect()->route('cities.index');
    }
}
