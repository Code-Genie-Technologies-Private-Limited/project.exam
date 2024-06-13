<?php

namespace App\Http\Controllers;

use App\Models\Copy;
use App\Http\Requests\StoreCopyRequest;
use App\Http\Requests\UpdateCopyRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CopyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $copies = Copy::with('creator')
            ->orderBy('name')
            ->paginate(10);

        return view('dashboard.copyies.index', compact('copies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.copyies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCopyRequest $request)
    {
        Copy::array_merge($request->validated(), ['created_by' =>auth()->user()->id]);
        return redirect()->route('copyies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Copy $copy)
    {
        return view('dashboard.copyies.show', compact('copy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Copy $copy)
    {
        return view('dashboard.copyies.edit', compact('copy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCopyRequest $request, Copy $copy)
    {
        $copy->update($request->validated());
        return redirect()->route('copyies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Copy $copy)
    {
        $copy->delete();
        return redirect()->route('copy.index');
    }
}
