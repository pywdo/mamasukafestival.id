<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Courses;
use App\Models\CoursesSegment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Courses::join('category', 'courses.category_id', '=', 'category.id')
            // ->leftJoin('transaction', 'courses.id', '=', 'transaction.courses_id')
            ->leftJoin('transaction', function ($join) {
                $join->on('courses.id', '=', 'transaction.courses_id');
                $join->on('transaction.status', '=', DB::raw("1"));
            })
            ->groupBy('courses.id')
            ->orderBy('total_user', 'desc')
            ->get([
                'courses.*',
                'category.name as category_name',
                DB::raw("count(transaction.id) as total_user")
            ]);

        $pageName = 'Kursus';

        return view('admin.courses.index', compact('data', 'pageName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageName = 'Kursus';

        $category = Category::all();
        return view('admin.courses.create', compact('category', 'pageName'));
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
            'category' => 'required|not_in:"Pilih Kategori"',
            'name' => 'required|unique:courses',
            'price' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'segment.*.title' => 'required',
            'segment.*.embed' => 'required',
        ], config('global.validator'));

        $imageName = time() . '.' . $request->thumbnail->extension();

        $request->thumbnail->move(public_path('images'), $imageName);

        $courses = Courses::create([
            'category_id' => $request->category,
            'name' => $request->name,
            'price' => $request->price,
            'thumbnail' => $imageName,
            'description' => $request->description,
        ]);

        $segment = [];
        $no = 1;
        foreach ($request->segment as $key => $value) {
            $segment[] = [
                'id' => Str::uuid()->toString(),
                'courses_id' => $courses->id,
                'name' => $value['title'],
                'embed' => $value['embed'],
                'ordering' => $no,
            ];
            $no++;
        }

        CoursesSegment::insert($segment);

        return redirect()->route('admin.courses')
            ->with('success', 'Berhasil menambah kursus.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function show(Courses $courses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function edit(Courses $course)
    {
        $segments = CoursesSegment::where('courses_id', $course->id)->orderBy('ordering', 'asc')->get();
        $category = Category::all();

        $pageName = 'Kursus';

        return view('admin.courses.edit', compact('course', 'segments', 'pageName', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courses $course)
    {
        $request->validate([
            'category' => 'required|not_in:"Pilih Kategori"',
            'name' => 'required',
            'price' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'segment.*.title' => 'required',
            'segment.*.embed' => 'required',
        ], config('global.validator'));



        $imageName = time() . '.' . $request->thumbnail->extension();

        $request->thumbnail->move(public_path('images'), $imageName);

        $course->update([
            'category_id' => $request->category,
            'name' => $request->name,
            'price' => $request->price,
            'thumbnail' => $imageName,
            'description' => $request->description,
        ]);

        $segment = [];
        $no = 1;
        foreach ($request->segment as $key => $value) {
            $segment[] = [
                'id' => Str::uuid()->toString(),
                'courses_id' => $course->id,
                'name' => $value['title'],
                'embed' => $value['embed'],
                'ordering' => $no,
            ];
            $no++;
        }
        CoursesSegment::where('courses_id', $course->id)->delete();
        CoursesSegment::insert($segment);

        return redirect()->route('admin.courses')
            ->with('success', 'Berhasil menambah kursus.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courses $course)
    {
        CoursesSegment::where('courses_id', $course->id)->delete();

        $course->delete();

        return redirect()->route('admin.courses')
            ->with('success', 'Kursus berhasil dihapus.');
    }
}
