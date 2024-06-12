<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = District::with('creator')
            ->orderBy('name', 'asc')
            ->paginate();

        return view('dashboard.districts.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.districts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDistrictRequest $request)
    {
        District::create(array_merge(
            $request->validated(),
            ['created_by' => auth()->user()->id]
        ));

        $request->session()->flash('message', 'created successfully.');

        return redirect()->route('districts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(District $district)
    {
        return view('dahboard.districts.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(District $district)
    {
        return view('dashboard.districts.index', compact('district'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDistrictRequest $request, District $district)
    {
        $district->update($request->validated());

        $request->session()->flash('message', 'updated successfully');

        return redirect()->route('districts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district, Request $request)
    {
        $district->delete();

        $request->session()->flash('message', 'deleted successfully.');
    }
}
