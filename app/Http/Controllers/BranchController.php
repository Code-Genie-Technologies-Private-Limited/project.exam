<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Models\User;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $branches = Branch::with('creator')
            ->filter($request->all())
            ->orderBy('order', 'desc')
            ->paginate($perPage)
            ->appends($request->query());

        $creators = User::all();

        return view('dashboard.branches.index', [
            'branches' => $branches,
            'creators' => $creators,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request)
    {
        Branch::create(array_merge(
            $request->validated(),
            ['created_by' => auth()->user()->id]
        ));

        return redirect()->route('branches.index', $request->query())
            ->with('message', 'Branch has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch, Request $request)
    {
        $creators = User::all();

        return view('dashboard.branches.show', [
            'branch' => $branch,
            'creators' => $creators,
            'filters' => $request->query()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch, Request $request)
    {
        $creators = User::all();

        return view('dashboard.branches.edit', [
            'branch' => $branch,
            'creators' => $creators,
            'filters' => $request->query()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        $branch->update($request->validated());

        return redirect()->route('branches.index', $request->query())
            ->with('message', 'Branch has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch, Request $request)
    {
        $filters = $request->input('_token', '_method');

        return redirect()->route('branches.index', $filters)
            ->with('message', 'Branch has been added successfully.');
    }
}
