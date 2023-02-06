<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use File;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Client::all();
        $pageName = 'Client';
        $title='Client';
        return view('admin.client.index', compact('data', 'pageName','title'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageName = 'Client';
        $title='Client';
        return view('admin.client.create', compact('pageName','title'));
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
            'name' => 'required|unique:clients',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], config('global.validator'));

        $imageName = time() . '.' . $request->thumbnail->extension();

        $request->thumbnail->move('images', $imageName);
        // $request->thumbnail->storeAs('images', $imageName);

        Client::create([
            'name' => $request->name,
            'thumbnail' => $imageName,
        ]);

        return redirect('admin/client')
            ->with('success', 'Berhasil menambah Client.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {

         $pageName = 'Client';
         
         
        return view('admin.client.edit', compact('pageName','client'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
       
       
        $rules=[
            'name' => 'required|unique:clients,name,' . $client->id,
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'. $client->id,
        ];

        $validateData = $request->validate($rules); //validasi



        if ($request->file('thumbnail')) {

            if ($client->thumbnail) {

                File::delete('images/'.$client->thumbnail);
            }
            $imageName = time() . '.' . $request->thumbnail->extension();
        $request->thumbnail->move('images',$imageName);
       $validateData['thumbnail']=$imageName;
        }
        $client->update( $validateData,[
            'name' => $request->name,
            
        ]);

        return redirect('admin/client')
            ->with('success', 'Client berhasil diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        
        if ($client->thumbnail) {
            File::delete(public_path().'/images/'.$client->thumbnail);
        }
            Client::destroy($client->id);
            return redirect('admin/client')
            ->with('success', 'Client berhasil dihapus.');
    }
}