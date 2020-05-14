<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Alert;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isTraining || auth()->user()->isCDI){
            return view('dashboard.course.all');
        }else{
            return redirect()->back();
        }
        
    }

    public function get_all(){
        $courses = Course::orderBy('created_at', 'DESC')->get();
        return DataTables::of($courses)
                ->addColumn('view', function($courses) {
                    return '
                        <a href="/dashboard/courses/'.$courses->id.'/delete" style="margin-right:10px;" class="red-text">x</a>
                    ';
                })
                ->rawColumns(['view'])
                ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->isTraining){
            return view('dashboard.course.new');
        }else{
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // abort_unless(auth()->user()->isAdmin, 403, 'You are not authorised to view this page!');
        $validation = $request->validate([
            'title' => 'required|string',
            'institution' => 'required|string',
            'location' => 'required|string',
            'type' => 'required|string',
            'course' => 'required|string',
            'startdate' => 'required|date',
            'enddate' => 'required|date'
        ]);
        $courses = Course::create([
            'title' => $request->title,
            'institution' => $request->institution,
            'location' => $request->location,
            'type' => $request->type,
            'course' => $request->course,
            'startdate' => $request->startdate,
            'enddate' => $request->enddate
        ]);

        if($courses){
            Alert::success('Course record added successfully!', 'Success!')->autoclose(2500);
            return redirect()->route('courses_new');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }
    
    
    public function search()
    {
        return view('dashboard.course.search');
    }
    
    public function courses_search(Request $request)
    {
        $result = Course::where('title', 'like', "%{$request->title}%")->with('users')->get();
        return view('dashboard.course.search', compact(['result']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        Alert::success('Course record deleted successfully!', 'Success!')->autoclose(2500);
        return redirect()->back();
    }

    public function statistics(){
        
    }
}
