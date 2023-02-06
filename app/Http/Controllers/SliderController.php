<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Slider::all();
        $pageName = 'Slider';
        return view('admin.slider.index', compact('data', 'pageName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageName = 'Slider';
        return view('admin.slider.create', compact('pageName'));
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
            'name' => 'required|unique:slider',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
        ], config('global.validator'));

        $imageName = time() . '.' . $request->thumbnail->extension();

        $request->thumbnail->move('images', $imageName);
        // $request->thumbnail->storeAs('images', $imageName);

        Slider::create([
            'name' => $request->name,
            'thumbnail' => $imageName,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.slider')
            ->with('success', 'Berhasil menambah slider.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $pageName = 'Slider';
        return view('admin.slider.edit', compact('slider', 'pageName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $rules=[
            'name' => 'required|unique:slider,name,' . $slider->id,
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
        ];

        $validateData = $request->validate($rules); //validasi



        if ($request->file('thumbnail')) {

            if ($slider->thumbnail) {

                File::delete('images/'.$slider->thumbnail);
            }
            $imageName = time() . '.' . $request->thumbnail->extension();
        $request->thumbnail->move('images',$imageName);
       $validateData['thumbnail']=$imageName;
        }
        $slider->update($validateData,[
            'name' => $request->name,
            
            'content' => $request->content,
        ]);

        return redirect()->route('admin.slider')
            ->with('success', 'Slider berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        if ($slider->thumbnail) {

            File::delete('images/'.$slider->thumbnail);
        }
        Slider::where('id', $slider->id)->delete();

        $slider->delete();

        return redirect()->route('admin.slider')
            ->with('success', 'Kursus berhasil dihapus.');
    
    }
}
