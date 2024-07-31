<?php

namespace App\Http\Controllers;

use App\Documents\BlogDocument;
use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\BlogDetail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

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
    public function create(): View
    {
        return view('dashboard.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request): RedirectResponse
    {
        if ($request->hasFile('filename')) {
            $allowedfileExtension = ['pdf', 'jpg', 'jpeg', 'png', 'docx'];
            $files = $request->file('filename');

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $size = $file->getSize();

                if (!in_array($extension, $allowedfileExtension)) {
                    return redirect()->back()
                        ->withErrors(
                            ['filename' => 'Invalid file extension. Allowed extensions are: ' . implode(', ', $allowedfileExtension)]
                        );
                }

                if ($size > 2048 * 1024) {
                    return redirect()->back()
                        ->withErrors(
                            ['filename' => 'Files exceed the maximum allowed size of 2MB.']
                        );
                }
            }

            $blog = Blog::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $uniqueFileName = time() . '_' . uniqid() . '.' . $extension;
                $path = $file->storeAs('photos', $uniqueFileName, 'public');

                BlogDetail::create([
                    'blog_id' => $blog->id,
                    'filename' => $path
                ]);
            }
        } else {
            $blog = Blog::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));
        }

        return redirect()->route('blogs.index', $request->query())
            ->with('message', 'The blog has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog, Request $request): View
    {
        $blogFileDetails = $blog->blogFileDetails;

        return view('dashboard.blogs.show', [
            'blog' => $blog,
            'blogFileDetails' => $blogFileDetails,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog, Request $request): View
    {
        $blogFileDetails = $blog->blogFileDetails;

        return view('dashboard.blogs.edit', [
            'blog' => $blog,
            'blogFileDetails' => $blogFileDetails,
            'filters' => $request->query(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if ($request->hasFile('filename')) {
            $allowedfileExtension = ['pdf', 'jpg', 'jpe', 'png', 'docx'];
            $files = $request->file('filename');

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $size = $file->getSize();

                if (!in_array($extension, $allowedfileExtension)) {
                    return redirect()->back()
                        ->withErrors(
                            ['filename' => 'Invalid file extension. Allowed extensions are: ' . implode(', ', $allowedfileExtension)]
                        );
                }

                if ($size > 2048 * 1024) {
                    return redirect()->back()
                        ->withErrors(
                            ['filename' => 'Files exceed the maximum allowed size of 2MB.']
                        );
                }
            }

            $blog->update($request->validated());

            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $uniqueFileName = time() . '_' . uniqid() . '.' . $extension;
                $path = $file->storeAs('photos', $uniqueFileName, 'public');

                BlogDetail::create([
                    'blog_id' => $blog->id,
                    'filename' => $path,
                ]);
            }
        } else {
            $blog->update($request->validated());
        }

        return redirect()->route('blogs.index', $request->query())
            ->with('message', 'The blog has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog, Request $request)
    {
        $filters = $request->except('_token', '_method');

        $blog->blogFileDetails()->delete();

        $blog->delete();

        return redirect()->route('blogs.index', $filters)
            ->with('message', 'The blog has been deleted successfully.');
    }

    /**
     * Download the specified resource in PDF format.
     *
     * @param Blog $subject
     * @param Request $request
     * @return View
     */
    public function downloadPDF($id)
    {
        $subject = Blog::find($id);
        $subjectPDF = new BlogDocument($subject);
        return $subjectPDF->generate();
    }

    /**
     * Download the specified resource in HTML format.
     *
     * @param $id
     * @param Request $request
     * @return View
     */
    public function downloadHTML($id)
    {
        $blogs = Blog::find($id);
        $blogHTML = new BlogDocument($blogs);
        return $blogHTML->generate('html');
    }
}
