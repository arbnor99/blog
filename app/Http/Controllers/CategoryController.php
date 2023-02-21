<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = auth()->user()->categories()->get();

        return view('categories/index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('categories/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            Category::create([
                'user_id' => auth()->user()->id,
                'name' => filter_var($request->input('name'), FILTER_SANITIZE_STRING),
                'description' => filter_var($request->input('description'), FILTER_SANITIZE_STRING),
            ]);

            return Redirect::route('categories.index')->with('Success', 'Successfully stored category');
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return Redirect::route('categories.create')->with('ServerError', 'Failed to store category');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Category $category)
    {
        return view('categories/show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Category $category)
    {
        return view('categories/edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $category->update([
                'name' => filter_var($request->input('name'), FILTER_SANITIZE_STRING),
                'description' => filter_var($request->input('description'), FILTER_SANITIZE_STRING)
            ]);

            return Redirect::route('categories.show', ['category' => $category])->with('Success', 'Successfully updated category');
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return Redirect::route('categories.edit', ['category' => $category])->with('ServerError', 'Failed to update category');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return Redirect::route('categories.index')->with('Success', 'Successfully deleted category');
        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return Redirect::route('categories.edit')->with('ServerError', 'Failed to delete category');
        }
    }
}
