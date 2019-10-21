<?php

namespace App\Http\Controllers;

use App\Account;
use App\Doctor;
use App\Treatment;
use App\Redeployment;
use App\Vital;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        $payments_today = $payments_pending = $payments_success = $payments_cancelled = NULL;
        $treatments_today = $treatments_pending = $treatments_success = $treatments_cancelled = NULL;
        $nurse_treatments_today = $nurse_treatments_pending = $nurse_treatments_success = $nurse_treatments_cancelled = NULL;
        $doctor_treatments_today = $doctor_treatments_pending = $doctor_treatments_success = $doctor_treatments_cancelled = NULL;

        if (auth()->user()->isRecord) {
            $treatments_today = Treatment::whereDate('created_at', Carbon::today())->get();
            $treatments_pending = Treatment::with('patient')->get();
            $treatments_success = Treatment::where('status', 6)->get();
            $treatments_cancelled = Treatment::where('status', 0)->get();
        }
        if(auth()->user()->isAccount){
            $payments_today = Account::whereDate('created_at', Carbon::today())->get();
            $payments_pending = Account::where('status', 1)->with('treatment', 'patient')->get();
            $payments_success = Account::where('status', 2)->get();
            $payments_cancelled = Account::where('status', 0)->get();
        }
        if(auth()->user()->isNurse){
            $nurse_treatments_today = Treatment::where('status', 2)->whereDate('created_at', Carbon::today())->get();
            $nurse_treatments_pending = Treatment::where('status', 2)->with('patient')->get();
            $nurse_treatments_success = Vital::get();
            $nurse_treatments_cancelled = Treatment::where('status', 0)->get();
        }
        if(auth()->user()->isDoctor){
            $doctor_treatments_today = Treatment::where('status', 3)->whereDate('created_at', Carbon::today())->get();
            $doctor_treatments_pending = Treatment::where('status', 3)->with('patient')->get();
            $doctor_treatments_success = Doctor::get();
            $doctor_treatments_cancelled = Treatment::where('status', 0)->get();
        }
        
        return view('dashboard.dashboard', compact([
            'payments_today', 'payments_pending', 'payments_success', 'payments_cancelled',
            'treatments_today', 'treatments_pending', 'treatments_success', 'treatments_cancelled',
            'nurse_treatments_today', 'nurse_treatments_pending', 'nurse_treatments_success', 'nurse_treatments_cancelled',
            'doctor_treatments_today', 'doctor_treatments_pending', 'doctor_treatments_success', 'doctor_treatments_cancelled'
        ]));
    }
}
