<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Http\Requests\StorePhoneRequest;
use App\Http\Requests\UpdatePhoneRequest;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phones = Phone::with('creator')
            ->orderBy('name', 'desc')
            ->paginate(10);

        return view('dashboard.phones.index', compact('phones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.phones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhoneRequest $request)
    {
        Phone::create(array_merge($request->validated(),
         ['created_by' => auth()->user()->id]));
        return redirect()->route('phones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Phone $phone)
    {
        return view('dashboard.phones.show', compact('phone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Phone $phone)
    {
        return view('dashboard.phones.edit', compact('phone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhoneRequest $request, Phone $phone)
    {
        $phone->update($request->validated());
        return redirect()->route('phones.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Phone $phone, Request $request)
    {
        $phone->delete();
        return redirect()->route('phones.index');
    }
}
