<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $perPage = $request->input('per_page', 10);

        $branches = Branch::filter($request->all())
            ->with('creator')
            ->orderBy('order', 'desc')
            ->paginate($perPage)
            ->appends($request->query());

        $creators = User::all();

        return view('dashboard.branches.index', [
            'branches' => $branches,
            'creators' => $creators,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request): RedirectResponse
    {
        Branch::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('branches.index', $request->query())
            ->with('message', 'Branch is created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch, Request $request): View
    {
        return view('dashboard.branches.show', [
            'branch' => $branch,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch, Request $request): View
    {
        return view('dashboard.branches.edit', [
            'branch' => $branch,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $branch): RedirectResponse
    {
        $branch->update($request->validated());

        return redirect()->route('branches.index', $request->query())
            ->with('message', 'Branch is Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch, Request $request): RedirectResponse
    {
        $filters = $request->exists('_token', '_method');

        $branch->delete();

        return redirect()->route('branches.index', $filters)
            ->with('message', 'Branch is deleted successfully');
    }
}