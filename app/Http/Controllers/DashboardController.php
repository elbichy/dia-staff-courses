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
        $data = null;
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
        
        return view('dashboard.dashboard', compact(['data']));
    }
}
