<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request request
     * @param view
     */
    public function index(Request $request):View
    {
        $perPage = $request->input('per_page', 10);

        $notices = Notice::filter($request->all())
            ->with('creator')
            ->orderBy('order', 'desc')
            ->paginate($perPage)
            ->appends($request->query());

        $creators = User::all();

        return view('dashboard.notices.index', [
            'notices' => $notices,
            'creators' => $creators,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return view
     */
    public function create():View
    {
        $notices = Notice::select('id', 'type')->distinct('')->get();
        return view('dashboard.notices.create', compact('notices'));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreBlogRequest $request
     * @param RedirectResponse
     */
    public function store(StoreNoticeRequest $request): RedirectResponse
    {
        Notice::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('notices.index', $request->query())
            ->with('message', 'The notice has been created successfully.');
    }

    /**
     * Display the specified resource.
     * @param Blog $blog
     * @param Request $request
     * @return view
     */
    public function show(Notice $notice, Request $request):View
    {
        return view('dashboard.notices.show', [
            'notice' => $notice,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Blog $blog
     * @param Request $request
     * @return view
     */
    public function edit(Notice $notice, Request $request):View
    {
        return view('dashboard.notices.edit', [
            'notice' => $notice,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateBlogRequest $request
     * @param Blog $blog
     * @return RedirectResponse
     */
    public function update(UpdateNoticeRequest $request, Notice $notice): RedirectResponse
    {
        $notice->update($request->validated());

        return redirect()->route('notices.index', $request->query())
            ->with('message', 'The notice has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param Blog $blog
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Notice $notice, Request $request): RedirectResponse
    {
        $filters = $request->except('_token', '_method');

        $notice->delete();

        return redirect()->route('notices.index', $filters)
            ->with('message', 'The notice has been deleted successfully.');
    }
}
