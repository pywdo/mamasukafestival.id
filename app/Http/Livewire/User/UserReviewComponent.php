<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\ModelS\Transaction;
use App\ModelS\Review;
use Illuminate\Http\Request;
use App\Models\Courses;

class UserReviewComponent extends Component
{


    public function index()
    {
        $data = Review::all();
       
        return view('users.review', compact('data'));
    }

    public function store(Request $request)
    {   
        
        $request->validate([
            'rating'=> 'required',
            'courses_id'=>'required',
            'comment'=>'required',
            'username'=>'required',
        ], config('global.validator'));

       
        Review::create([
            'rating' => $request->rating,
            'courses_id'=>$request->courses_id,
            'comment' => $request->comment,
            'username' => $request->username,
            
        ]);

        return redirect()->route('home.courses.mine')
            ->with('success', 'Terimakasih telah membuat ulasan.');
    }







    public $courses_id;
    public $rating;
    public $cmment;
    public function mount($courses_id)
    {
        $this->courses_id=$courses_id;
    }


    public function updated($fields){

        $this->validateOnly($fields,[
            'rating'=> 'required',
            'comment'=>'required'
        ]);
    }
    public function addReview($courses_id)

    { 
        
        
        
        
        
        dd('error');
       
        $this->validate([
            'rating'=> 'required',
            'comment'=>'required'
        ]);
        $review = new Review();
        $review->rating= $this->rating;
        $review->comment= $this->comment;
        $review->save();

        $Transaction=Transaction::find($this->courses_id);
        $Transaction->rstatus=true;
        $Transaction->save();
        session()->flash('message','Your review has been added successfully');
        
    }





    public function render()
    {
        $Transaction= Transaction::find($this->courses_id);
        return view('users.review',['Transaction'=>$Transaction])->layout('layouts.app');
    }
}
