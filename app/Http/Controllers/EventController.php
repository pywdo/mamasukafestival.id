<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use File;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Event::all();
        $pageName = 'Event';
        return view('admin.event.index', compact('data', 'pageName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageName = 'Event';
        return view('admin.event.create', compact('pageName'));
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
            'name' => 'required|unique:event',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
        ], config('global.validator'));

        $imageName = time() . '.' . $request->thumbnail->extension();

        $request->thumbnail->move('images', $imageName);
        // $request->thumbnail->storeAs('images', $imageName);

        Event::create([
            'name' => $request->name,
            'thumbnail' => $imageName,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.event')
            ->with('success', 'Berhasil menambah event.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $pageName = 'Event';
        return view('admin.event.edit', compact('event', 'pageName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $rules=[

            'name' => 'required|unique:event,name,' . $event->id,
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required',
        ];

        $validateData = $request->validate($rules); //validasi
		
		
		
        if ($request->file('thumbnail')) {

           
		 if ($event->thumbnail) {

            File::delete('images/'.$event->thumbnail);
        }	
			 $imageName = time() . '.' . $request->thumbnail->extension();
             $request->thumbnail->move('images',$imageName);
			$validateData['thumbnail']=$imageName;
        }
   

  
            
        $event->update($validateData,[
            'name' => $request->name,
			
            'content' => $request->content,
			 ]);

        return redirect()->route('admin.event')
            ->with('success', 'Event berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if ($event->thumbnail) {

            File::delete('images/'.$event->thumbnail);
        }
        Event::where('id', $event->id)->delete();

        $event->delete();

        return redirect()->route('admin.event')
            ->with('success', 'Kursus berhasil dihapus.');
    
    }
}
