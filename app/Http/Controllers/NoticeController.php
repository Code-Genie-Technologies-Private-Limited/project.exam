<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Models\User;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $notices = Notice::with('creator')
            ->filter($request->all())
            ->orderBy('order', 'desc')
            ->paginate($perPage)
            ->appends($request->query());

        $creators = User::all();

        return view('dashboard.notices.index', [
            'notices' => $notices,
            'creators' => $creators,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.notices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoticeRequest $request)
    {
        Notice::create(array_merge(
            $request->validated(),
            ['created_by' => auth()->user()->id]
        ));

        return redirect()->route('notices.index', $request->query())
            ->with('message', 'Notice has been added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice, Request $request)
    {
        $creators = User::all();

        return view('dashboard.notices.show', [
            'notice' => $notice,
            'creators' => $creators,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notice $notice, Request $request)
    {
        $creators = User::all();

        return view('dashboard.notices.edit', [
            'notice' => $notice,
            'creators' => $creators,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoticeRequest $request, Notice $notice)
    {
        $notice->update($request->validated());

        return redirect()->route('notices.index', $request->query())
            ->with('message', 'Notice has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice, Request $request)
    {
        $filters = $request->input('_token', '_method');

        $notice->delete();

        return redirect()->route('notices.index', $filters)
            ->with('message', 'Notice has been deleted successfully.');
    }
}
