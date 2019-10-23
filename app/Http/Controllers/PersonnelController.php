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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                        <a href="/personnel/'.$personnel->id.'/edit" style="margin-right:10px;" class="blue-text"><i class="small material-icons">edit</i></a>
                        <a href="/personnel/'.$personnel->id.'/download" class="green-text"><i class="small material-icons">cloud_download</i></a>
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
        return view('dashboard.staff.new');
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
            'service_number' => 'required|numeric',
            'fullname' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'doe' => 'required|date',
            'gl' => 'required|numeric',
            'category' => 'required|string',
            'directorate' => 'required|string',
            'isAdmin' => 'required|numeric'
        ]);

        $personnel = User::create([
            'service_number' => $request->service_number,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
            'gender' => $request->gender,
            'doe' => $request->doe,
            'gl' => $request->gl,
            'category' => $request->category,
            'directorate' => $request->directorate,
            'isAdmin' => $request->isAdmin
        ]);

        if($personnel){
            Alert::success('Personnel record added successfully!', 'Success!')->autoclose(2500);
            return redirect()->route('personnel_new');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function show(Personnel $personnel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function edit(Personnel $personnel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Personnel $personnel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personnel  $personnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Personnel $personnel)
    {
        //
    }

    public function statistics(){

    }
}
