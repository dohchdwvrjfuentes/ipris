<?php

namespace App\Http\Controllers;

use App\Person;
use App\Ethnicity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ethnicity $ethnicity)
    {   
        $addquery = "WHERE isIP = '1'";

        if(!empty(auth()->user()->area)){
            $addquery .= " AND province = " . auth()->user()->area;
        }

        $query = "select * from people $addquery";

        $people = DB::select(DB::raw($query));

        return view('people.index', compact('people', 'ethnicity'));
    }

    public function filter(Request $request, Person $person, Ethnicity $ethnicity)
    {


        $addquery = "WHERE isIP = '1' AND province = $request->province ";
        
        
        if(!empty($request->municipality)){
            $addquery .= "AND municipality = $request->municipality ";
        }
        
        if(!empty($request->barangay)){
            $addquery .= "AND barangay = $request->barangay ";
        }

        if(!empty($request->sex)){
            $addquery .= "AND sex = $request->sex ";
        }

        if(($request->min != null) && ($request->max != null)){
            $addquery .= "AND (age >= $request->min AND age <= $request->max )";
        }


        $query = "select * from people $addquery ";


        $people = DB::select(DB::raw($query));

        return view('people.index', compact('people', 'ethnicity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('people.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Person $person)
    {

        $data = $request->validate([

            'philhealth' => 'nullable',
            'household' => 'nullable',
            'surname' => 'required',
            'firstname' => 'required',
            'middlename' => '',
            'extension' => '',
            'sex' => 'required',
            'birthdate' => '',
            'age' => 'required',
            'birthreg' => '',
            'education' => 'required',
            'province' => 'required',
            'municipality' => 'required',
            'barangay' => 'required',
            'sitio' => '',
            'ethnicity' => 'required',
            'leader' => 'nullable',
            'isLeader' => 'nullable',
            'isIP' => 'nullable',
            'head' => '',
            'relhh' => 'required',

        ]);


        
        // Increment of code
        if(!Person::first()){
            $code =  $data['barangay'] . str_pad(1, 6, 0, STR_PAD_LEFT);
        }else{
            $order = Person::orderBy('id', 'DESC')->first();

            $code = $data['barangay'] . str_pad($order->id + 1, 6, 0, STR_PAD_LEFT);
        }

        // Validate if data already exist in DB
        if(Person::where('surname', $data['surname'])->where('firstname', $data['firstname'])->where('middlename', $data['middlename'])
        ->where('extension', $data['extension'])->count() > 0){

            return redirect()->back()->with('warning','Record already exists.');

        }else{
            // Insert new record if data doesnt exist
            $person->code = $code;
            $person->philhealth = $data['philhealth'];
            $person->household = $data['household'];
            $person->surname = $data['surname'];
            $person->firstname = $data['firstname'];
            $person->middlename = $data['middlename'];
            $person->extension = $data['extension'];
            $person->sex = $data['sex'];
            $person->birthdate = $data['birthdate'];
            $person->age = $data['age'];
            $person->birthreg = $data['birthreg'];
            $person->education = $data['education'];
            $person->province = $data['province'];
            $person->municipality = $data['municipality'];
            $person->barangay = $data['barangay'];
            $person->sitio = $data['sitio'];
            $person->ethnicity_id = $data['ethnicity'];
            $person->leader = $data['leader'];
            $person->isLeader = $data['isLeader'];
            $person->isIP = $data['isIP'];
            $person->head = $data['head'];
            $person->relhh = $data['relhh'];

            $person->save();

            return redirect()->back()->withStatus(__('Record successfully created.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        return view('people.show', compact('person'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        return view('people.edit', compact('person'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {

        $data = request()->validate([
            'id' => 'required',
            'philhealth' => 'nullable',
            'household' => 'nullable',
            'surname' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'extension' => 'required',
            'sex' => 'required',
            'birthdate' => 'required',
            'age' => 'required',
            'birthreg' => 'required',
            'education' => 'required',
            'region' => 'required',
            'province' => 'required',
            'municipality' => 'required',
            'barangay' => 'required',
            'sitio' => 'required',
            'ethnicity_id' => 'required',
            'leader' => 'required',
            'head' => 'required',
            'relhh' => 'required',

        ]);

        $person->update($data);

        return redirect()->route('person.show', $person->id)->withStatus(__('Record successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }
}
