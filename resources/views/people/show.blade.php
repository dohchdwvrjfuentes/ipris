@extends('layouts.app', ['titlePage' => __('Show - Indigenous Peoples Registry System')])

@section('content')
    {{-- PHP --}}
    @php
        use Illuminate\Support\Facades\DB;
        use App\Person;

        $relhh = DB::table('relhhs')->where('id', $person->relhh)->first();
        $education = DB::table('education')->where('id', $person->education)->first();

        $province = DB::table('province')->where('provcode', $person->province )->first();
        $municipality = DB::table('municipality')->where('muncode', $person->municipality )->first();
        $barangay = DB::table('barangay')->where('brgycode', $person->barangay )->first();

        $ethnicity = DB::table('ethnicities')->where('id', $person->ethnicity_id)->first();
        
    @endphp
    {{-- PHP --}}
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav justify-content-between">
                            <span class="nav-item text-left"><h4 class="card-title text-left"><i class="fas fa-user"></i> ID #{{ $person->barangay . $person->id }}</h4></span>
                            <div class="form-inline">
                                <li class="nav-item p-1"><a href="{{ route('person.index') }}" class="btn btn btn-danger shadow-sm"><i class="far fa-arrow-alt-circle-left"></i> {{ __('Return List') }}</a></li>
                                <li class="nav-item p-1"> <a href="{{ route('person.edit', $person->id) }}" class="btn btn-primary shadow-sm"><i class="fas fa-edit" style="--fa-primary-color: white"></i> {{ __('Edit') }}</a></li>
                            </div>
                        </ul>
                        @if (session('warning'))
                        <div class="row">
                          <div class="col-sm-10">
                            <div class="alert alert-warning">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="fas fa-window-close text-danger"></i>
                              </button>
                              <span>{{ session('warning') }}</span>
                            </div>
                          </div>
                        </div>
                        @elseif(session('status'))
                        <div class="row">
                          <div class="col-sm-10">
                            <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="fas fa-window-close text-danger"></i>
                              </button>
                              <span>{{ session('status') }}</span>
                            </div>
                          </div>
                        </div>
                        @endif
                        <hr>
                        <label for="person info"><h4>Personal Information</h4></label>
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <dt for="surname" class="col-sm-4 col-form-dt">Family Name</dt>
                                    <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext" id="surname" value="{{ $person->surname }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                <dt for="firstname" class="col-sm-4 col-form-dt">First Name</dt>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="firstname" value="{{ $person->firstname }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <dt for="middlename" class="col-sm-4 col-form-dt">Middle Name</dt>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="middlename" value="{{ $person->middlename }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <dt for="extension" class="col-sm-4 col-form-dt">Extension</dt>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="extension" value="{{ $person->extension }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <dt for="relhh" class="col-sm-4 col-form-dt">Relation to HH</dt>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="relhh" value="{{ $relhh->name }}">
                                    </div>
                                </div>
                            </div>
                                
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <dt for="sex" class="col-sm-4 col-form-dt">Sex</dt>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="sex" value="{{ $person->sex == 1 ? 'MALE' : 'FEMALE'}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <dt for="birthdate" class="col-sm-4 col-form-dt">Birthdate</dt>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="birthdate" value="{{ \Carbon\Carbon::parse($person->birthdate)->toFormattedDateString() }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <dt for="age" class="col-sm-4 col-form-dt">Age</dt>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="age" value="{{ \Carbon\Carbon::parse($person->birthdate)->age }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <dt for="birthreg" class="col-sm-4 col-form-dt">Birth Registration</dt>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="birthreg" value="{{ $person->birthreg }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <dt for="education" class="col-sm-4 col-form-dt">Highest Educational Attainment</dt>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control-plaintext" id="education" value="{{ $education->name }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                          <hr>
                          <label for="Address"><h4>Address</h4></label>
                          <div class="form-group row">
                            <dt for="region" class="col-sm-2 col-form-dt">Region</dt>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control-plaintext" id="region" value="{{ $person->region == '60000000' ? 'WESTERN VISAYAS' : '' }}">
                            </div>
                          </div>
                          <div class="form-group row">
                            <dt for="province" class="col-sm-2 col-form-dt">Province</dt>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control-plaintext" id="province" value="{{ $province->provname }}">
                            </div>
                          </div>
                          <div class="form-group row">
                            <dt for="municipality" class="col-sm-2 col-form-dt">Municipality/City</dt>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control-plaintext" id="municipality" value="{{ $municipality->munname }}">
                            </div>
                          </div>
                          <div class="form-group row">
                            <dt for="barangay" class="col-sm-2 col-form-dt">Barangay</dt>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control-plaintext" id="barangay" value="{{ $barangay->brgyname }}">
                            </div>
                          </div>
                          <div class="form-group row">
                            <dt for="sitio" class="col-sm-2 col-form-dt">Sitio</dt>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control-plaintext" id="sitio" value="{{ $person->sitio }}">
                            </div>
                          </div>
                          <hr>
                          <label for=""><h4>Government Information</h4></label>
                          <div class="form-group row">
                            <dt for="philhealth" class="col-sm-2 col-form-dt">Philhealth No.</dt>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control-plaintext" id="philhealth" value="{{ $person->philhealth }}">
                            </div>
                          </div>
                          <div class="form-group row">
                            <dt for="household" class="col-sm-2 col-form-dt">DSWD Household No.</dt>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control-plaintext" id="household" value="{{ $person->household }}">
                            </div>
                          </div>
                          <hr>

                          <label for="ethnicity"><h4>Ethnicity Information</h4></label>
                          <div class="form-group row">
                            <dt for="ethnicity" class="col-sm-2 col-form-dt">Ethnicity</dt>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control-plaintext" id="ethnicity" value="{{ $ethnicity->name }}">
                            </div>
                          </div>
                          <div class="form-group row">
                            <dt for="leader" class="col-sm-2 col-form-dt">Leader</dt>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control-plaintext" id="leader" value="{{ $person->leader != 'null' ?  $person->leader : 'NONE' }}">
                            </div>
                          </div>
                          <div class="form-group row">
                            <dt for="head" class="col-sm-2 col-form-dt">Household Head</dt>
                            <div class="col-sm-10">
                              <input type="text" readonly class="form-control-plaintext" id="head" value="{{ $person->head != 'null' ? $person->head : 'NONE' }}">
                            </div>
                          </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection