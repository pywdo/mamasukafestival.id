<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::all();

        $pageName = 'Kategori';

        return view('admin.category.index', compact('data', 'pageName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageName = 'Kategori';
        return view('admin.category.create', compact('pageName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:category',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], config('global.validator'));

        $imageName = time() . '.' . $request->thumbnail->extension();

        $request->thumbnail->move(public_path('images'), $imageName);
        // $request->thumbnail->storeAs('images', $imageName);

        Category::create([
            'name' => $request->name,
            'thumbnail' => $imageName,
        ]);

        return redirect()->route('admin.category')
            ->with('success', 'Berhasil menambah kategori.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $pageName = 'Kategori';
        return view('admin.category.edit', compact('category', 'pageName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:category,name,' . $category->id,
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], config('global.validator'));

        $imageName = time() . '.' . $request->thumbnail->extension();

        $request->thumbnail->move(public_path('images'), $imageName);

        $category->update([
            'name' => $request->name,
            'thumbnail' => $imageName,
        ]);

        return redirect()->route('admin.category')
            ->with('success', 'Kategori berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // dd($category);
        $category->delete();

        return redirect()->route('admin.category')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
