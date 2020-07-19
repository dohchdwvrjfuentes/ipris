@extends('layouts.app', ['titlePage' => __('Home - Indigenous Peoples Registry System')])

@section('content')
@php
    use Illuminate\Support\Facades\DB;

@endphp
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card px-2 shadow-sm">
                <div class="card-body pb-0">
                    <ul class="nav justify-content-between">
                    <span class="nav-item text-left"><h4 class="card-title text-left"><i class="fas fa-server"></i> {{ __('Dashboard') }} {{ isset($address) ? $address : '' }}</h4></span>
                        @auth()
                            <div class="form-inline">
                            <li class="nav-item p-1"><a href="{{ route('person.create') }}" class="btn btn btn-success shadow-sm"><i class="fas fa-user-plus" style="--fa-primary-color: white"></i> {{ __('Add Data') }}</a></li>
                            <li class="nav-item p-1"> <a href="{{ route('person.index') }}" class="btn btn-primary shadow-sm"><i class="fas fa-search" style="--fa-primary-color: white"></i> {{ __('View Masterlist') }}</a></li>
                            </div>
                        @endauth
                    </ul>
                </div>
                <hr>
                <div class="row justify-content-center py-4">
                    <div class="col-lg-12">
                        <form>
                            <div class="form-row">
                    <div class="col-lg-2">
                        <select class="form-control shadow-sm input-province" id="province" name="province">
                        @auth
                            @php
                                $province = DB::table('province')->where('provcode', Auth::user()->area)->first();
                            @endphp

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
                        @endauth
                        @guest
                            <option disabled selected>Select Province</option>
                            <option value="0604">AKLAN</option>
                            <option value="0606">ANTIQUE</option>
                            <option value="0619">CAPIZ</option>
                            <option value="0679">GUIMARAS</option>
                            <option value="0630">ILOILO</option>
                            <option value="0645">NEGROS OCCIDENTAL</option>
                        @endguest
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
                                <div class="col-lg-3">
                                    <button class="btn col-lg-5 btn-primary shadow" type="button" id="filter"><i class="fas fa-filter" style="--fa-primary-color: white"></i> Filter</button>
                                    <button class="btn col-lg-5 btn-danger shadow" id="reset"><i class="fas fa-undo" style="--fa-primary-color: white"></i> Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <label for="population"><i class="fas fa-users"></i> Population</label>
                                <div class="row text-center">
                                    <div class="col">
                                        <h4>{{ isset($people) ? count($people) : 0}}</h4>
                                    <small class="text-info">As of {{\Carbon\Carbon::now()->toFormattedDateString()}}</small>
                                    </div>
                                </div>
                                <hr>
                                <label for="population"><i class="fas fa-home"></i> Household</label>
                                <div class="row text-center">
                                    <div class="col">
                                        <h4>{{ isset($household) ? count($household) : 0}}</h4>
                                    <small class="text-info">As of {{\Carbon\Carbon::now()->toFormattedDateString()}}</small>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <label for="sex_distribution"><i class="fas fa-venus-mars"></i> Sex Distribution</label>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="card px-4 pb-4">
                                            <div class="card-body pb-0">
                                                <h4>{{ isset($male) ? count($male) : 0}}</h4>
                                            </div>
                                            <hr>
                                            <div class="card-footer rounded bg-primary text-white"><i class="fas fa-mars"></i>  MALE </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="card px-4 pb-4">
                                            <div class="card-body pb-0">
                                                <h4>{{ isset($female) ? count($female) : 0}}</h4>
                                            </div>
                                            <hr>
                                            <div class="card-footer rounded bg-danger text-white"><i class="fas fa-venus"></i> FEMALE </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center py-4">
                    <div class="col-lg-7">
                        <div class="row px-4 pb-4 justify-content-center">
                            <div class="card col-lg-12 shadow-sm">
                                <div class="card-body">
                                    <label for="age_bracket"><i class="fas fa-user-friends"></i> Ethnicity Distribution</label>
                                    <div class="row text-center">
                                        <div class="col-lg-4">
                                            <div class="card shadow-sm">
                                                <div class="card-body">
                                                    <div class="card-body pb-0">
                                                        <h4>{{ isset($aeta) ? count($aeta) : 0}}</h4>
                                                        <small></small>
                                                    </div>
                                                    <hr>
                                                    <div class="card-footer rounded bg-success text-white"> ATI/ATA </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card shadow-sm">
                                                <div class="card-body">
                                                    <div class="card-body pb-0">
                                                        <h4>{{ isset($bukidnon) ? count($bukidnon) : 0}}</h4>
                                                        <small></small>
                                                    </div>
                                                    <hr>
                                                    <div class="card-footer rounded bg-primary text-white"> BUKIDNON </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card shadow-sm">
                                                <div class="card-body">
                                                    <div class="card-body pb-0">
                                                        <h4>{{ isset($others) ? count($others) : 0}}</h4>
                                                        <small></small>
                                                    </div>
                                                    <hr>
                                                    <div class="card-footer rounded bg-danger text-white"> OTHERS </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>            
                        </div>
                        <div class="row px-4 py-2 justify-content-center">
                            <div class="card col-lg-12 shadow-sm">
                                <div class="card-body">
                                    <label for="age_bracket"><i class="fas fa-user-friends"></i> Leaders Distribution</label>
                                    <div class="row text-center">
                                        <div class="col-lg-4">
                                            <div class="card shadow-sm">
                                                <div class="card-body">
                                                    <div class="card-body pb-0">
                                                        <h4>{{ isset($l_male) ? count($l_male) + count($l_female) : 0}}</h4>
                                                    </div>
                                                    <hr>
                                                    <div class="card-footer rounded bg-success text-white"> TOTAL </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card shadow-sm">
                                                <div class="card-body">
                                                    <div class="card-body pb-0">
                                                        <h4>{{ isset($l_male) ? count($l_male) : 0}}</h4>
                                                    </div>
                                                    <hr>
                                                    <div class="card-footer rounded bg-primary text-white"><i class="fas fa-mars fa-xs"></i> MALE </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card shadow-sm">
                                                <div class="card-body">
                                                    <div class="card-body pb-0">
                                                        <h4>{{ isset($l_female) ? count($l_female) : 0}}</h4>
                                                    </div>
                                                    <hr>
                                                    <div class="card-footer rounded bg-danger text-white"><i class="fas fa-venus fa-xs"></i> FEMALE </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>             
                        </div>
                        <div class="row px-4 py-4 justify-content-center">
                            <div class="col-lg-12">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <label for="population"><i class="fas fa-users"></i> PhilHeath Members</label>
                                        <div class="row text-center">
                                            <div class="col">
                                                <h4>{{ isset($philhealth) ? count($philhealth) : 0}}</h4>
                                            <small class="text-info">As of {{\Carbon\Carbon::now()->toFormattedDateString()}}</small>
                                            </div>
                                        </div>
                                        <hr>
                                        <label for="population"><i class="fas fa-home"></i> DSWD Households</label>
                                        <div class="row text-center">
                                            <div class="col">
                                                <h4>{{ isset($dswd) ? count($dswd) : 0}}</h4>
                                            <small class="text-info">As of {{\Carbon\Carbon::now()->toFormattedDateString()}}</small>
                                            </div>
                                        </div>
                                    </div>
        
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <label for="age_bracket"><i class="fas fa-baby"></i> Age Bracket Distribution</label>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-striped table-hover">
                                            <thead class="text-center">
                                                <th class="text-success">YEARS</th>
                                                <th class="text-info">MALE</th>
                                                <th class="text-danger">FEMALE</th>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                <td><strong> 0-4 </strong></td>
                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 1 AND age BETWEEN 0 AND 4"))) : 0 }}</td>

                                                    <td>{{isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 2 AND age BETWEEN 0 AND 4"))) : 0 }}</td>
                                                    </tr>
                                                <tr>
                                                    <td><strong> 5-9 </strong></td>
                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 1 AND age BETWEEN 5 AND 9"))) : 0 }}</td>

                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 2 AND age BETWEEN 5 AND 9"))) : 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong> 10-14 </strong></td>
                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 1 AND age BETWEEN 10 AND 14"))) : 0 }}</td>

                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 2 AND age BETWEEN 10 AND 14"))) : 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong> 15-19 </strong></td>
                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 1 AND age BETWEEN 15 AND 19"))) : 0 }}</td>

                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 2 AND age BETWEEN 15 AND 19"))) : 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong> 20-24 </strong></td>
                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 1 AND age BETWEEN 20 AND 24"))) : 0 }}</td>

                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 2 AND age BETWEEN 20 AND 24"))) : 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong> 25-29 </strong></td>
                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 1 AND age BETWEEN 25 AND 29"))) : 0 }}</td>

                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 2 AND age BETWEEN 25 AND 29"))) : 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong> 30-34 </strong></td>
                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 1 AND age BETWEEN 30 AND 34"))) : 0 }}</td>

                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 2 AND age BETWEEN 30 AND 34"))) : 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong> 35-39 </strong></td>
                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 1 AND age BETWEEN 35 AND 39"))) : 0 }}</td>

                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 2 AND age BETWEEN 35 AND 39"))) : 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong> 40-44 </strong></td>
                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 1 AND age BETWEEN 40 AND 44"))) : 0 }}</td>

                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 2 AND age BETWEEN 40 AND 44"))) : 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong> 45-49 </strong></td>
                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 1 AND age BETWEEN 45 AND 49"))) : 0 }}</td>

                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 2 AND age BETWEEN 45 AND 49"))) : 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong> 50-54 </strong></td>
                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 1 AND age BETWEEN 50 AND 54"))) : 0 }}</td>

                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 2 AND age BETWEEN 50 AND 54"))) : 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong> 55-59 </strong></td>
                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 1 AND age BETWEEN 55 AND 59"))) : 0 }}</td>

                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 2 AND age BETWEEN 55 AND 59"))) : 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong> 60-64 </strong></td>
                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 1 AND age BETWEEN 60 AND 64"))) : 0 }}</td>

                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 2 AND age BETWEEN 60 AND 64"))) : 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong> 65-69 </strong></td>
                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 1 AND age BETWEEN 65 AND 69"))) : 0 }}</td>

                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 2 AND age BETWEEN 65 AND 69"))) : 0 }}</td>
                                                </tr>      
                                                <td><strong> 70- Above </strong></td>
                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 1 AND age >= 70"))) : 0 }}</td>

                                                    <td>{{ isset($basequery) ?
                                                    count( DB::select(DB::raw($basequery . " AND sex = 2 AND age >= 70"))) : 0 }}</td>
                                                </tr>           
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewList" tabindex="-1" role="dialog" aria-labelledby="viewListTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewListTitle"><i class="fas fa-cogs"></i> Advanced Options</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="">
            <div class="modal-body px-4">
                    <label for="Area">Area</label>
                    <div class="form-row">
                        <div class="col-lg-3">
                            <select class="form-control shadow-sm input-province" id="province">
                                <option value="all" selected>SELECT ALL</option>
                                <option value="0604">AKLAN</option>
                                <option value="0606">ANTIQUE</option>
                                <option value="0619">CAPIZ</option>
                                <option value="0679">GUIMARAS</option>
                                <option value="0630">ILOILO</option>
                                <option value="0645">NEGROS OCCIDENTAL</option>
                            </select>            
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control shadow-sm input-mun" id="municipality">
                                {{-- JS get municipality --}}
                            </select>            
                        </div>
                        <div class="col-lg-5">
                            <select class="form-control shadow-sm input-brgy" id="barangay">
                                {{-- JS get barangay --}}
                        </div>                       
                    </div>
                <hr>  
               
                    <div class="form-group">
                            <div class="form-row">
                        <label for="Sex">Sex</label>
                        <select class="form-control col-lg-4 shadow-sm" id="sex">
                                <option value="null">All</option>
                                <option value="1">Male</option>
                                <option value="0">Female</option>
                        </select>
                    </div>

                </div>

                <hr> 
                <div class="form-group">
                    <label for="Age">Age</label>
                        <div class="form-check px-4 col-lg-12">
                            <label class="form-check-label" for="age">
                            <input class="form-check-input" type="checkbox" id="all_age" checked>
                                Select All
                            </label>
                        </div>
                    <div class="form-row">
                        <div class="form-group col-lg-3">
                            <label for="min_age">Minimum</label>
                            <input type="text" class="form-control" id="min_age" disabled>
                        </div>
                        <div class="form-group col-lg-3">
                            <label for="max_age">Maximum</label>
                            <input type="text" class="form-control" id="max_age" disabled>            
                        </div>
                    </div>
                </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"><i class="fas fa-location-arrow"></i> Proceed </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
