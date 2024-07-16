<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $perPage = $request->input('per_page', 10);

        $blogs = Blog::filter($request->all())
            ->with('creator')
            ->orderBy('order')
            ->paginate($perPage)
            ->appends($request->query());

        $creators = User::all();

        return view('dashboard.blogs.index', [
            'blogs' => $blogs,
            'creators' => $creators,
            'filters' => $request->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request): RedirectResponse
    {
        Blog::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect('blogs.index', $request->query())
            ->with('message', 'Blog is created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog, Request $request): View
    {
        return view('dashboard.blogs.show', [
            'blog' => $blog,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog, Request $request): View
    {
        return view('dashboard.blogs.edit', [
            'blog' => $blog,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog): RedirectResponse
    {
        $blog->update($request->valideted());

        return redirect()->route('blogs.index', $request->query())
            ->with('message', 'Blog is updated successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog, Request $request): RedirectResponse
    {
        $filters = $request->except('_token', '_method');
        $blog->delete();

        return redirect()->route('blogs.index', $filters)
            ->with('message', 'Blog Is deleted successfully!!!');
    }
}
