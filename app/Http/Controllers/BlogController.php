<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Blog::class, 'blog');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $blogs = auth()->user()->blogs()->with('categories')->get();

        return view('blogs/index', [
            'blogs' => $blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = auth()->user()->categories()->get();

        return view('blogs/create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBlogRequest $request)
    {
        try {
            $blog = Blog::create([
                'user_id' => auth()->user()->id,
                'title' => filter_var($request->input('title'), FILTER_SANITIZE_STRING),
                'description' =>filter_var($request->input('description'), FILTER_SANITIZE_STRING),
                'content' =>filter_var($request->input('content'), FILTER_SANITIZE_STRING),
            ]);
            $blog->categories()->attach($request->input('categories'));

            if($request->file('image')) {
                $blog->addMedia($request->file('image'))->toMediaCollection('images');
            }

            return Redirect::route('blogs.index')->with('Success', 'Successfully stored blog');
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return Redirect::route('blogs.create')->with('ServerError', 'Failed to store blog because of a server error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Blog $blog)
    {
        $blog->with('user');
        return view('blogs/show', [
            'blog' => $blog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Blog $blog)
    {
        $blog->with('categories');
        $categories = auth()->user()->categories()->get();
        return view('blogs/edit', [
            'blog' => $blog,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        try {
            $blog->update([
                'title' => filter_var($request->input('title'), FILTER_SANITIZE_STRING),
                'description' => filter_var($request->input('description'), FILTER_SANITIZE_STRING),
                'content' => filter_var($request->input('content'), FILTER_SANITIZE_STRING),
            ]);
            $blog->categories()->sync($request->input('categories'));

            if($request->file('image')) {
                $blog->clearMediaCollection('images');
                $blog->addMedia($request->file('image'))->toMediaCollection('images');
            }

            return Redirect::route('blogs.show', ['blog' => $blog])->with('Success', 'Successfully updated blog');
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return Redirect::route('blogs.edit', ['blog' => $blog])->with('ServerError', 'Failed to update blog');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Blog $blog)
    {
        try {
            $blog->delete();
            return Redirect::route('blogs.index')->with('Success', 'Successfully deleted blog');
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return Redirect::route('blogs.edit')->with('ServerError', 'Failed to delete blog');
        }
    }
}
