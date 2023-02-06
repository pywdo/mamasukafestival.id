<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Courses;
use App\Models\CoursesSegment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use File;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $keyword =$request->keyword;
        $data = Courses::join('category', 'courses.category_id', '=', 'category.id')
            // ->leftJoin('transaction', 'courses.id', '=', 'transaction.courses_id')
            ->leftJoin('transaction', function ($join) {
                $join->on('courses.id', '=', 'transaction.courses_id');
                $join->on('transaction.status', '=', DB::raw("1"));
            })
            ->where('courses.name','LIKE','%'.$keyword.'%')
            ->orWhere('courses.description','LIKE','%'.$keyword.'%')
            ->orWhere( 'category.name', 'LIKE','%'.$keyword.'%')
            ->orWhere( 'courses.price', 'LIKE','%'.$keyword.'%')
            ->groupBy('courses.id')
            // ->orderBy('total_user', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10,[
                'courses.*',
                'category.name as category_name',
                DB::raw("count(transaction.id) as total_user")
            ]);
          
        
        $pageName = 'Kursus';

        return view('admin.courses.index', compact(
            'data','pageName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageName = 'Kursus';
        $user = User::where('is_admin',2)->get()->all();
        $category = Category::all();
        return view('admin.courses.create', compact('user','category', 'pageName'));
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
            'user' => 'required|not_in:"Pilih Pemateri"',
            'name' => 'required|unique:courses',
            'price' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'preview' => 'required',
            'segment.*.title' => 'required',
            'segment.*.embed' => 'required',
        ], config('global.validator'));

        $imageName = time() . '.' . $request->thumbnail->extension();

        $request->thumbnail->move(public_path('images'), $imageName);

        $courses = Courses::create([
            'category_id' => $request->category,
            'user_id' => $request->user,
            'name' => $request->name,
            'price' => $request->price,
            'thumbnail' => $imageName,
            'description' => $request->description,
            'preview' => $request->preview,
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
        $user = User::where('is_admin',2)->get()->all();
     
        $pageName = 'Kursus';

        return view('admin.courses.edit', compact('user','course', 'segments', 'pageName', 'category'));
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
        $rules=[
            'category' => 'required|not_in:"Pilih Kategori"',
            'user' => 'required|not_in:"Pilih Pemateri"',
           
            'name' => 'required',
            'price' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'preview' => 'required',
            'segment.*.title' => 'required',
            'segment.*.embed' => 'required',
        ];

        $validateData = $request->validate($rules); //validasi



        if ($request->file('thumbnail')) {

            if ($course->thumbnail) {

                File::delete('images/'.$course->thumbnail);
            }
            $imageName = time() . '.' . $request->thumbnail->extension();
        $request->thumbnail->move('images',$imageName);
       $validateData['thumbnail']=$imageName;
        }
        $course->update($validateData,[
            'category_id' => $request->category,
            'user_id' => $request->user,
            'name' => $request->name,
            'price' => $request->price,
           
            'description' => $request->description,
            'preview' => $request->preview,
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
            ->with('success', 'Berhasil mengedit kursus.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Courses  $courses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courses $course)
    {
        if ($course->thumbnail) {

            File::delete(public_path().'/images/'.$course->thumbnail);
        }
        CoursesSegment::where('courses_id', $course->id)->delete();

        $course->delete();

        return redirect()->route('admin.courses')
            ->with('success', 'Kursus berhasil dihapus.');
    }
}
