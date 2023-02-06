<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

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
        $pageName = 'Store';
        return view('admin.category.index', compact('data', 'pageName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageName = 'Store';
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
            ->with('success', 'Berhasil Menambah Data.');
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
        $pageName = 'Store';
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
        $rules=[
            'name' => 'required|unique:category,name,' . $category->id,
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validateData = $request->validate($rules); //validasi



        if ($request->file('thumbnail')) {

            if ($category->thumbnail) {

                File::delete('images/'.$category->thumbnail);
            }
            $imageName = time() . '.' . $request->thumbnail->extension();
        $request->thumbnail->move('images',$imageName);
       $validateData['thumbnail']=$imageName;
        }
        $category->update( $validateData,[
            'name' => $request->name,
            
        ]);

        return redirect()->route('admin.category')
            ->with('success', 'Data Store berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
       
        if ($category->thumbnail) {
            File::delete(public_path().'/images/'.$category->thumbnail);
        }
            Category::destroy($category->id);
            return redirect()->route('admin.category')
            ->with('success', 'Data berhasil dihapus.');
    }
}
