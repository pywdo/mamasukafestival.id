<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Courses::orderBy('created_at', 'desc')->get();
        return view('home.courses.index', compact('data'));
    }

    public function adminHome()
    {
        return view('admin.home');
    }

    public function event()
    {
        $data = Event::orderBy('created_at', 'desc')->get();
        return view('home.event.index', compact('data'));
    }

    public function eventDetail($id)
    {
        $data = Event::find($id);
        return view('home.event.detail', compact('data'));
    }
}
