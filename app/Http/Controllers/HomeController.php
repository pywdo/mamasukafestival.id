<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Courses;
use App\Models\User;
use App\Models\CoursesSegment;
use App\Models\Event;
use App\Models\Slider;
use App\Models\Review;
use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $data = Courses::query();
        $pageName = 'Kursus Terbaru';
        $isSearch = false;
        if (request('search')) {
            $data->where('name', 'Like', '%' . request('search') . '%');
            $pageName = request('search');
            $isSearch = true;
        }

        $data = $data->orderBy('updated_at', 'desc')->Paginate(6)->withQueryString();

        $category = Category::orderby('name', 'asc')->get();

        $event = Event::orderby('created_at', 'desc')->limit(5)->get();
        $slider = Slider::orderby('created_at', 'desc')->limit(5)->get();
 $client = Client::orderby('updated_at', 'desc')->get();

        return view('home.courses.index', compact('data', 'pageName', 'isSearch', 'category', 'event','slider','client'));
    }

    public function categoryDetail($id)
    {
        $data = Courses::where('category_id', $id)
            ->orderBy('created_at', 'desc')->get();
        $category = Category::orderby('name', 'asc')->get();
        $pageName = 'Kursus Terbaru';

        foreach ($category as $c) {
            if ($c->id == $id) {
                $pageName = $c->name;
            }
        }

        return view('home.courses.category', compact('data', 'pageName', 'category'));
    }

    public function mine()
    {
        $data = Courses::join('transaction', 'courses.id', '=', 'transaction.courses_id')
            ->where('transaction.user_id', Auth::id())
            ->where('transaction.status', 1)->get(['courses.*']);

      
        $pageName = 'Akun Saya';
       
        return view('home.courses.mine', compact('data', 'pageName'));
    }


    public function teacher()
    {
        $data = Courses::join('category', 'courses.category_id', '=', 'category.id')
        // ->join('users', 'courses.user_id', '=', 'users.id')
        // ->leftJoin('transaction', 'courses.id', '=', 'transaction.courses_id')
        ->leftJoin('transaction', function ($join) {
            $join->on('courses.id', '=', 'transaction.courses_id');
            $join->on('transaction.status', '=', DB::raw("1"));
        })
        ->where('courses.user_id',auth()->user()->id)
        ->groupBy('courses.id')
        ->orderBy('total_user', 'desc')
        
        ->Paginate(5,[
            'courses.*',
            'category.name as category_name',
            DB::raw("count(transaction.id) as total_user")
        ]);


        return view('home.courses.teacher', compact('data'));
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


    public function slider()
    {
        $data = Slider::orderBy('created_at', 'desc')->get();
        return view('home.slider.index', compact('data'));
    }

    public function sliderDetail($id)
    {
        $data = Slider::find($id);
        return view('home.slider.detail', compact('data'));
    }






    public function coursesDetail($id)
    {
        $data = Courses::find($id);
        $review = Review::where('courses_id', $id)->orderBy('created_at', 'desc')->Paginate(5);
        $sumrating=Review::where('courses_id', $id)->pluck('rating')->avg();
      
        $segments = CoursesSegment::where('courses_id', $id)->orderBy('ordering', 'asc')->get();
        $isPurchased = 0;
        $transaction = Transaction::where('user_id', Auth::id())
            ->where('courses_id', $id)
            ->where('status', '!=', 2)
            ->first();
		

        if ($transaction) {
            if ($transaction->status == 1) {
                $isPurchased = 1;
            } else if ($transaction->status == 0) {
                $isPurchased = 99;
            }
        }

        return view('home.courses.detail', compact('sumrating','review','data', 'segments', 'isPurchased','transaction'));
    }
}
