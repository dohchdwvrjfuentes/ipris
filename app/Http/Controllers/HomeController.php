<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Person;

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
        return view('home');
    }

    public function getMunicipality(Request $request){
        

        $municipalities = DB::table('municipality')->where('provcode', $request->province)->get();

        $output = "<option disabled selected>Select Municipality</option>";
        foreach($municipalities as $municipality){
            $output .="<option value='$municipality->muncode'> $municipality->munname </option>";
        }

        return $output;
        exit;
    }

    public function getBarangay(Request $request){
        

        $barangays = DB::table('barangay')->where('provcode', $request->province)->where('muncode', $request->municipality)->get();

        $output = "<option disabled selected>Select Barangay</option>";
        $output .= "<option value='null'>NONE</option>";
        foreach($barangays as $barangay){
            $output .="<option value='$barangay->brgycode'> $barangay->brgyname </option>";
        }

        return $output;
        exit;
    }

    public function getLeader(Request $request){
        

        $leaders = Person::where('municipality', $request->municipality)->where('barangay', $request->barangay)->where('isLeader', '1')->get();

        $output = "<option disabled selected>Select Leader</option>";
        $output .= "<option value='null'>NONE</option>";
        foreach($leaders as $leader){
            $output .="<option> $leader->surname, $leader->firstname  $leader->middlename  $leader->extension </option>";
        }

        return $output;
        exit;
    }

    public function getHead(Request $request){
        

        $heads = Person::where('municipality', $request->municipality)->where('barangay', $request->barangay)->where('relhh', '1')->get();

        $output = "<option disabled selected>Select Head</option>";
        $output .= "<option value='null'>NONE</option>";
        foreach($heads as $head){
            $output .="<option> $head->surname, $head->firstname  $head->middlename  $head->extension </option>";
        }

        return $output;
        exit;
    }

    public function getAreaData(Request $request, Person $person){

        $p = DB::table('province')->where('provcode', $request->province)->first();
        $m = DB::table('municipality')->where('muncode', $request->municipality)->first();
        $b = DB::table('barangay')->where('brgycode', $request->barangay)->first();

        $address = '';

        if(!empty($p)){
            $address .= "- " . $p->provname;
        }

        if(!empty($m)){
            $address .= " > " . $m->munname;
        }

        if(!empty($b)){
            $address .= " > " . $b->brgyname;
        }


        $addquery = "WHERE isIP = '1' AND province = $request->province ";
        
        if(!empty($request->municipality)){
            $addquery .= "AND municipality = $request->municipality ";
        }
        
        if(!empty($request->barangay)){
            $addquery .= "AND barangay = $request->barangay ";
        }

        $basequery = "select * from people $addquery ";

        $people = DB::select(DB::raw($basequery));
        $household = DB::select(DB::raw($basequery . " AND relhh = '1'"));
        $male = DB::select(DB::raw($basequery . " AND sex = '1'"));
        $female = DB::select(DB::raw($basequery . " AND sex = '2'"));

        $aeta = DB::select(DB::raw($basequery . " AND ethnicity_id = '1'"));
        $bukidnon = DB::select(DB::raw($basequery . " AND ethnicity_id = '2'"));
        $others = DB::select(DB::raw($basequery . " AND ethnicity_id = '3'"));
        
        $l_male = DB::select(DB::raw($basequery . " AND sex = '1' AND isLeader = '1'"));
        $l_female = DB::select(DB::raw($basequery . " AND sex = '2' AND isLeader = '1'"));

        $philhealth = DB::select(DB::raw($basequery . " AND philhealth != 'N/A'"));
        $dswd = DB::select(DB::raw($basequery . " AND household != 'N/A'"));

        $age04 = DB::select(DB::raw($basequery . " AND age BETWEEN 0 AND 4"));

        return view('home', compact('address',
            'people', 'household', 'male', 'female',
            'aeta', 'bukidnon', 'others',
            'l_male', 'l_female',
            'philhealth', 'dswd', 'basequery'
        ));
    }
}
