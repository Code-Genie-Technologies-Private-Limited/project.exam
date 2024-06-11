<?php

namespace App\Http\Controllers;

use App\Models\Klass;
use App\Http\Requests\StoreKlassRequest;
use App\Http\Requests\UpdateKlassRequest;
use Illuminate\Http\Request;

class KlassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $klasses = Klass::with('creator')
            ->orderBy('order', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('dashboard.klasses.index', compact('klasses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.klasses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKlassRequest $request)
    {
        Klass::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));
        $request->session()->flash('message', 'Class has been added successfully.');

        return redirect()->route('klasses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Klass $klass)
    {
        return view('dashboard.klasses.show', compact('klass'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Klass $klass)
    {
        return view('dashboard.klasses.edit', compact('klass'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKlassRequest $request, Klass $klass)
    {
        $klass->update($request->validated());
        $request->session()->flash('message', 'Class has been updated successfully.');

        return redirect()->route('klasses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Klass $klass, Request $request)
    {
        $klass->delete();
        $request->session()->flash('message', 'Class has been deleted successfully.');

        return redirect()->route('klasses.index');
    }
}
