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
        return view('dashboard.course.all');
    }

    public function get_all(){
        $courses = Course::orderBy('created_at', 'DESC')->get();
        return DataTables::of($courses)
                ->editColumn('created_at', function ($courses) {
                    return $courses->created_at->toFormattedDateString();
                })
                ->addColumn('view', function($courses) {
                    return '
                        <a href="/courses/'.$courses->id.'/edit" style="margin-right:10px;" class="blue-text"><i class="small material-icons">edit</i></a>
                        <a href="/courses/'.$courses->id.'/download" class="green-text"><i class="small material-icons">cloud_download</i></a>
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
        return view('dashboard.course.new');
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
            'start_date' => 'required|date',
            'end_date' => 'required|date'
        ]);
        $courses = Course::create([
            'title' => $request->title,
            'institution' => $request->institution,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
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
        //
    }

    public function statistics(){
        
    }
}
