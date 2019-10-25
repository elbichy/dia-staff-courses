<?php

namespace App\Http\Controllers;

use App\Course;
use App\Personnel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Alert;
use Yajra\DataTables\Facades\DataTables;

class PersonnelController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    // ALL PERSONNEL
    public function index()
    {
        return view('dashboard.staff.all');
    }
    public function get_all(){
        $personnel = User::orderBy('created_at', 'DESC')->get();
        return DataTables::of($personnel)
                ->editColumn('created_at', function ($personnel) {
                    return $personnel->created_at->toFormattedDateString();
                })
                ->addColumn('view', function($personnel) {
                    return '
                        <a href="/dashboard/personnel/'.$personnel->id.'/profile" class="login_btn btn-small btn waves-effect waves-light"><i class="material-icons left">person</i> View Profile</a>
                    ';
                })
                ->rawColumns(['view'])
                ->make();
    }

   
    // MILITARY PERSONNEL
    public function military()
    {
        return view('dashboard.staff.military');
    }
    public function get_all_military(){
        $personnel = User::where('category', 'military')->orderBy('created_at', 'DESC')->get();
        return DataTables::of($personnel)
                ->editColumn('created_at', function ($personnel) {
                    return $personnel->created_at->toFormattedDateString();
                })
                ->addColumn('view', function($personnel) {
                    return '
                        <a href="/dashboard/personnel/'.$personnel->id.'/profile" class="login_btn btn-small btn waves-effect waves-light"><i class="material-icons left">person</i> View Profile</a>
                    ';
                })
                ->rawColumns(['view'])
                ->make();
    }

   
    // SENIOR PERSONNEL
    public function senior()
    {
        return view('dashboard.staff.senior');
    }
    public function get_all_senior(){
        $personnel = User::where('category', 'senior')->orderBy('created_at', 'DESC')->get();
        return DataTables::of($personnel)
                ->editColumn('created_at', function ($personnel) {
                    return $personnel->created_at->toFormattedDateString();
                })
                ->addColumn('view', function($personnel) {
                    return '
                        <a href="/dashboard/personnel/'.$personnel->id.'/profile" class="login_btn btn-small btn waves-effect waves-light"><i class="material-icons left">person</i> View Profile</a>
                    ';
                })
                ->rawColumns(['view'])
                ->make();
    }

   
    // JUNIOR PERSONNEL
    public function junior()
    {
        return view('dashboard.staff.junior');
    }
    public function get_all_junior(){
        $personnel = User::where('category', 'junior')->orderBy('created_at', 'DESC')->get();
        return DataTables::of($personnel)
                ->editColumn('created_at', function ($personnel) {
                    return $personnel->created_at->toFormattedDateString();
                })
                ->addColumn('view', function($personnel) {
                    return '
                        <a href="/dashboard/personnel/'.$personnel->id.'/profile" class="login_btn btn-small btn waves-effect waves-light"><i class="material-icons left">person</i> View Profile</a>
                    ';
                })
                ->rawColumns(['view'])
                ->make();
    }

   

    // CREATE
    public function create()
    {
        return view('dashboard.staff.new');
    }

   

    // STORE
    public function store(Request $request)
    {
        
        // abort_unless(auth()->user()->isAdmin, 403, 'You are not authorised to view this page!');
        $validation = $request->validate([
            'service_number' => 'required|string',
            'fullname' => 'required|string',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'doe' => 'required|date',
            'gl' => 'required|numeric',
            'category' => 'required|string',
            'directorate' => 'required|string'
        ]);

        $personnel = User::create([
            'service_number' => $request->service_number,
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'doe' => $request->doe,
            'gl' => $request->gl,
            'category' => $request->category,
            'directorate' => $request->directorate
        ]);

        if($personnel){
            Alert::success('Personnel record added successfully!', 'Success!')->autoclose(2500);
            return redirect()->route('personnel_new');
        }
    }

   
    
    // SHOW PROFILE
    public function show(User $user)
    {
        $user = User::where('id', $user->id)->with('courses')->first();
        $all_courses = Course::all();
        return view('dashboard.staff.profile', compact(['user', 'all_courses']));
    }

    
    

    public function edit(Personnel $personnel)
    {
        //
    }

    
    

    public function update(Request $request, Personnel $personnel)
    {
        //
    }

    
    
    // ASSIGN NEW COURSE
    public function assign(Request $request, User $user)
    {
        $validation = $request->validate([
            'course' => 'required|numeric'
        ]);

        $attached = $user->courses()->attach($request->course);
        Alert::success('Course assigned successfully!', 'Success!')->autoclose(2500);
        return redirect()->back();
    }

  
    
    // REMOVE A COURSE
    public function detach(User $user, Course $course)
    {
        $detached = $user->courses()->detach($course->id);
        Alert::success('Course removed successfully!', 'Success!')->autoclose(2500);
        return redirect()->back();
    }

    
    

    public function destroy(Personnel $personnel)
    {
        //
    }
    
}
