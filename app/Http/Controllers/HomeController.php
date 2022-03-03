<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Courses;
use App\Models\CoursesSegment;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $data = $data->orderBy('created_at', 'desc')->get();

        $category = Category::orderby('name', 'asc')->get();

        $event = Event::limit(5)->get();

        return view('home.courses.index', compact('data', 'pageName', 'isSearch', 'category', 'event'));
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

        return view('home.courses.index', compact('data', 'pageName', 'category'));
    }

    public function mine()
    {
        $data = Courses::join('transaction', 'courses.id', '=', 'transaction.courses_id')
            ->where('transaction.user_id', Auth::id())
            ->where('transaction.status', 1)->get(['courses.*']);
        $pageName = 'Kursus Saya';

        return view('home.courses.index', compact('data', 'pageName'));
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

    public function coursesDetail($id)
    {
        $data = Courses::find($id);

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

        return view('home.courses.detail', compact('data', 'segments', 'isPurchased'));
    }
}
