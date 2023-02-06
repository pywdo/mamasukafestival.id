<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $keyword =$request->keyword;
        // $data = Contact::all();

        
        $keyword =$request->keyword;
        $data = DB::table('contacts')
        ->select('id','view','subject','name','email','phone','created_at','message')   
        ->where('name','LIKE','%'.$keyword.'%')
        ->orWhere('email','LIKE','%'.$keyword.'%')
        ->orWhere('subject','LIKE','%'.$keyword.'%')
        ->orWhere( 'phone', 'LIKE','%'.$keyword.'%')
        ->orWhere( 'message', 'LIKE','%'.$keyword.'%')
        ->orWhere( 'created_at', 'LIKE','%'.$keyword.'%')
        ->groupBy('id')
        // ->orderBy('total_user', 'desc')
        ->orderBy('created_at')
        ->paginate(5);

        $pageName = 'Contact Us';
        $title ='Contact Us';
        return view('dashboard.contact.index', compact('data', 'pageName','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageName = 'Contact Us';
        return view('dashboard.contact.create', compact('pageName'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
            'subject'=>'required',
        ]);
        
        Contact::create($validateData);
        return redirect('contactus')->with('success', 'Thanks for your Proposal');
    
    }

    public function storehome(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
            'subject'=>'required',
        ]);
        
        Contact::create($validateData);
        return redirect('/#contact')->with('success', 'Thanks for your Proposal');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Contact::find($id);
        $title = "Contact Us";
        if($data) {
            $data->view = '1';
            $data->save();
        }
        return view('dashboard.contact.show', compact('data','title'));
    
      
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }

    

}
