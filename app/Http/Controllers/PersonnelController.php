<?php

namespace App\Http\Controllers;

use App\Course;
use App\Personnel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Alert;
use App\Document;
use App\Posting;
use App\Progression;
use Illuminate\Support\Facades\Storage;
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
                        <a href="/dashboard/personnel/'.$personnel->id.'/profile" class="login_btn btn-small btn waves-effect waves-light">Browse</a>
                    ';
                })
                ->rawColumns(['view'])
                ->make();
    }

   
    // CONTRACT PERSONNEL
    public function contract()
    {
        return view('dashboard.staff.contract');
    }
    public function get_all_contract(){
        $personnel = User::where('category', 'contract')->orderBy('created_at', 'DESC')->get();
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

   
    // ARCHIVED PERSONNEL
    public function archive()
    {
        return view('dashboard.staff.archive');
    }
    public function get_all_archive(){
        $personnel = User::where(function ($query) {
            $query->where('category', 'transfered')
                  ->orWhere('category', 'retired')
                  ->orWhere('category', 'dismissed')
                  ->orWhere('category', 'resined');
        })->orderBy('created_at', 'DESC')->get();
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
        if(auth()->user()->isAdmin){
            return view('dashboard.staff.new');
        }else{
            return redirect()->back();
        }
    }

   

    // STORE
    public function store(Request $request)
    {
        
        // abort_unless(auth()->user()->isAdmin, 403, 'You are not authorised to view this page!');
        $validation = $request->validate([
            'service_number' => 'required|string',
            'servicename' => 'required|string',
            'fullname' => 'required|string',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'doe' => 'required|date',
            'soo' => 'required|string',
            'lgoo' => 'required|string',
            'gl' => 'required|numeric',
            'category' => 'required|string',
            'directorate' => 'required|string'
        ]);

        $image_name = NULL;
        if($request->has('passport')){

            $val = $request->validate([
                'passport' => 'required|image|mimes:jpeg,png,jpg,|max:800',
            ]);

            $file = $request->file('passport');
            $image = $file->getClientOriginalName();
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            $image_name = $request->service_number.'.'.$ext;
            $file->storeAs('public/documents/'.$request->service_number.'/passport/', $image_name);
            // $image->storeAs('public/documents/'.$request->service_number.'/passport/', $image->getClientOriginalName());
        }

        $personnel = User::create([
            'service_number' => $request->service_number,
            'servicename' => $request->servicename,
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'doe' => $request->doe,
            'soo' => $request->soo,
            'lgoo' => $request->lgoo,
            'gl' => $request->gl,
            'category' => $request->category,
            'directorate' => $request->directorate,
            'passport' => $image_name
        ]);

        if($personnel){
            if($request->has('file')){

                $images = $request->file('file');
                foreach($images as $image)
                {
                    $file_name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $image->storeAs('public/documents/'.$personnel->service_number.'/', $image->getClientOriginalName());

                    $upload = User::find($personnel->id)->documents()->create([
                        'title' => $file_name,
                        'file' => $image->getClientOriginalName()
                    ]);
                }
            }
            Alert::success('Personnel record added successfully!', 'Success!')->autoclose(2500);
            return redirect()->back();
        }
    }

    
    // SHOW PROFILE
    public function show(User $user)
    {
        
        $personnel = User::where('service_number', $user->service_number)->with('documents', 'postings', 'progressions')->first();
        $foreign_courses = User::where('id', $user->id)->with(['courses' => function ($query) {
            $query->where('type', 'foreign');
        }])->first();

        $local_courses = User::where('id', $user->id)->with(['courses' => function ($query) {
            $query->where('type', 'local');
        }])->first();

        $all_courses = Course::all();

        return view('dashboard.staff.profile', compact(['all_courses', 'foreign_courses', 'local_courses', 'personnel']));
    }

      

    public function edit(User $user)
    {
        // return $user;
        return view('dashboard.staff.edit', compact('user'));
    }

    
    
    public function update(Request $request, User $user)
    {
        $image_name = $user->passport;
        if($request->has('passport')){

            $val = $request->validate([
                'passport' => 'required|image|mimes:jpeg,png,jpg,|max:900',
            ]);

            $file = $request->file('passport');
            $image = $file->getClientOriginalName();
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            $image_name = $request->service_number.'.'.$ext;
            $file->storeAs('public/documents/'.$request->service_number.'/passport/', $image_name);
        }

        $update = response()->json($user->update([
            'service_number' => $request->service_number,
            'servicename' => $request->servicename,
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'doe' => $request->doe,
            'soo' => $request->soo,
            'lgoo' => $request->lgoo,
            'gl' => $request->gl,
            'category' => $request->category,
            'directorate' => $request->directorate,
            'passport' => $image_name
        ]));
        if($update){
            Alert::success('Profile updated successfully!', 'Success!')->autoclose(2500);
            return redirect()->route('personnel_profile', $user->id);
        }
    }

    
    
    // UPLOAD NEW DOCUMENT
    public function upload_document(Request $request, User $user)
    {
       
        if($request->has('file')){
            $images = $request->file('file');
            foreach($images as $image)
            {
                $file_name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $image->storeAs('public/documents/'.$user->service_number.'/', $image->getClientOriginalName());

                $upload = User::find($user->id)->documents()->create([
                    'type' => $request->document_type,
                    'title' => $file_name,
                    'file' => $image->getClientOriginalName()
                ]);
            }
        }
        Alert::success('Document uploaded successfully!', 'Success!')->autoclose(2500);
        return redirect()->back();
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


    // ADD NEW PROGRESSION
    public function add_progression(Request $request, User $user)
    {
        $validation = $request->validate([
            'gl' => 'required|numeric',
            'gl_start' => 'required|date',
            'gl_end' => 'required|date'
        ]);
        $record = User::find($user->id)->progressions()->create([
            'gl' => $request->gl,
            'gl_start' => $request->gl_start,
            'gl_end' => $request->gl_end,
        ]);

        if($record){
            Alert::success('Progression record added successfully!', 'Success!')->autoclose(2500);
            return redirect()->back();
        }
    }
    // REMOVE A PROGRESSION
    public function remove_progression(User $user, Progression $progression)
    {
        $progression->delete();
        Alert::success('Progression removed successfully!', 'Success!')->autoclose(2500);
        return redirect()->back();
    }

    
    // ADD NEW POSTING
    public function add_posting(Request $request, User $user)
    {
        $validation = $request->validate([
            'directorate' => 'required|string',
            'directorate_start' => 'required|date',
            'directorate_end' => 'required|date'
        ]);
        $record = User::find($user->id)->postings()->create([
            'directorate' => $request->directorate,
            'directorate_start' => $request->directorate_start,
            'directorate_end' => $request->directorate_end,
        ]);

        if($record){
            Alert::success('Posting record added successfully!', 'Success!')->autoclose(2500);
            return redirect()->back();
        }
    }
    // REMOVE A POSTING
    public function remove_posting(User $user, Posting $posting)
    {
        $posting->delete();
        Alert::success('Posting removed successfully!', 'Success!')->autoclose(2500);
        return redirect()->back();
    }



    public function destroy(User $user)
    {
        Storage::deleteDirectory('public/documents/'.$user->service_number);
        $user->delete();
        Alert::success('Personnel record deleted successfully!', 'Success!')->autoclose(2500);
        return redirect()->route('personnel_all');
    }

    
    // DELETE PERSONNEL DOCUMENT
    public function destroyDocument($id)
    {
        $document = Document::where('id', $id)->with('user')->first();
        Storage::delete(['public/documents/'.$document->user->service_number.'/'.$document->file]);
        $document->delete();
        Alert::success('Document deleted successfully!', 'Success!')->autoclose(2500);
        return redirect()->back();
    }
    
}