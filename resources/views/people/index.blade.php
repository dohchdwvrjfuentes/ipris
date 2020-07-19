@extends('layouts.app', ['titlePage' => __('List - Indigenous Peoples Registry System')])

@section('content')
@php
    use Illuminate\Support\Facades\DB;
    
    $province = DB::table('province')->where('provcode', Auth::user()->area)->first();

@endphp
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card px-2 shadow-sm">
                <div class="card-body">
                    <a class="form-control-plaintext" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                        <i class="fas fa-cogs"></i> ADVANCED FILTER
                    </a>
                    <div class="collapse" id="collapse">
                    <div class="row justify-content-center py-4">
                        <div class="col-lg-12">
                            <label for="Area"><h5>AREA</h5></label>
                            <div class="form-row">
                                <div class="col-lg-2">
                                    <select class="form-control shadow-sm input-province" id="province" name="province">
                                    @if( Auth::user()->area == '')
                                        <option disabled selected>Select Province</option>
                                        <option value="0604">AKLAN</option>
                                        <option value="0606">ANTIQUE</option>
                                        <option value="0619">CAPIZ</option>
                                        <option value="0679">GUIMARAS</option>
                                        <option value="0630">ILOILO</option>
                                        <option value="0645">NEGROS OCCIDENTAL</option>
                                    @else
                                        <option disabled selected>Select Province</option>
                                        <option value="{{ Auth::user()->area }}">{{ $province->provname }}</option>
                                    @endif
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-control shadow-sm input-mun" id="municipality" name="municipality">
                                        {{-- JS get municipalities --}}
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <select class="form-control shadow-sm input-brgy" id="barangay" name="barangay">
                                        {{-- JS get barangays --}}
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-4">
                                        <label for="Area"><h5>SEX</h5></label>
                                        <div class="form-row">
                                            <div class="col-lg-6">
                                                <select class="form-control shadow-sm input-sex" id="sex" name="sex">
                                                    <option disabled selected>Select Sex</option>
                                                    <option value="1">MALE</option>
                                                    <option value="2">FEMALE</option>
                                                </select>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-lg-8">
                                    <label for="Area"><h5>AGE</h5></label>
                                    <div class="form-row">
                                        <div class="col-lg-2">
                                            <input type="text" class="form-control shadow-sm input-min" name="min" id="min" placeholder="Minimum">
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="text" class="form-control shadow-sm input-max" name="max" id="max" placeholder="Maximum">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                            <button type="button" class="btn btn-primary col-lg-1 shadow" id="search"><i class="fas fa-filter"></i>Filter</button>
                                            <button class="btn btn-danger col-lg-1 shadow" id="reset"><i class="fas fa-undo"></i> Reset</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <table id="ip" class="ui celled table table-bordered table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>PhilHealth No</th>
                                            <th>Household No</th>
                                            <th>Family Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Extension</th>
                                            <th>Birthdate</th>
                                            <th>Age</th>
                                            <th>Sex</th>
                                            <th>Ethnicity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($people as $person)
                                            @php

                                                $ethnicity = \App\Ethnicity::find($person->ethnicity_id);

                                            @endphp
                                            <tr>
                                            <td><a href="{{ route('person.show', $person->id) }}" target="_blank">{{$person->barangay . $person->id}}</a></td>
                                                <td>{{$person->philhealth}}</td>
                                                <td>{{$person->household}}</td>    
                                                <td>{{$person->surname}}</td>
                                                <td>{{$person->firstname}}</td>
                                                <td>{{$person->middlename}}</td>
                                                <td>{{$person->extension}}</td>
                                                <td>{{$person->birthdate == null ? 'N/A' : \Carbon\Carbon::parse($person->birthdate)->toFormattedDateString()}}</td>
                                                <td>{{$person->birthdate == null ? $person->age : \Carbon\Carbon::parse($person->birthdate)->age}}</td>
                                                <td>{{$person->sex == 1 ? 'MALE' : 'FEMALE'}}</td>
                                                <td>{{$ethnicity->name}}</td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                                <small>*Only Indigenous People are shown</small>                
                        </div>                
                    </div>
                </div>
            </div>

        </div>
    </div> 

</div>
@endsection

