<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $blogs = Blog::filter($request->all())
            ->with('creator')
            ->orderBy('order','desc')
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
    public function store(StoreBlogRequest $request)
    {
        Blog::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

        return redirect()->route('blogs.index', $request->query())
            ->with('message', 'The blog has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog , Request $request)
    {
        return view('dashboard.blogs.show', [
            'blog' => $blog,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog , Request $request)
    {
        return view('dashboard.blogs.edit', [
            'blog' => $blog,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $blog->update($request->validated());

        return redirect()->route('blogs.index', $request->query())
            ->with('message', 'The blog has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog, Request $request)
    {
        $filters = $request->except('_token', '_method');

        $blog->delete();

        return redirect()->route('blogs.index', $filters)
            ->with('message', 'The blog has been deleted successfully.');
    }
}
