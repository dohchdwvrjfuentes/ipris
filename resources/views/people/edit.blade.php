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
                                <li class="nav-item p-1"><a href="{{ route('person.show', $person->id) }}" class="btn btn btn-danger shadow-sm"><i class="far fa-arrow-alt-circle-left"></i> {{ __('Return') }}</a></li>
                            </div>
                        </ul>
                        <hr>
                  <form method="POST" action="{{ route('person.update', $person->id) }}">

                       @csrf
                       @method('put')

                        <input type="text" class="form-control" name="id" value="{{ $person->id }}" hidden="">
                        <label for="person info"><h4>Personal Information</h4></label>
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <dt for="surname" class="col-sm-4 col-form-dt">Family Name</dt>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control" name="surname" value="{{ $person->surname }}" onkeyup="this.value = this.value.toUpperCase();">
                                    </div>
                                </div>
                                <div class="form-group row">
                                <dt for="firstname" class="col-sm-4 col-form-dt">First Name</dt>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="firstname" value="{{ $person->firstname }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <dt for="middlename" class="col-sm-4 col-form-dt">Middle Name</dt>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="middlename" value="{{ $person->middlename }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <dt for="extension" class="col-sm-4 col-form-dt">Extension</dt>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="extension" value="{{ $person->extension }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                  <dt for="relhh" class="col-sm-4 col-form-dt">Relation to HH</dt>
                                  <div class="col-sm-8">
                                    <div class="form-group{{ $errors->has('relhh') ? ' has-danger' : '' }}">
                                      <select class="form-control col-lg-12" name="relhh">
                                          <option value="{{ $person->relhh }}" selected>{{ $relhh->name }}</option>
                                          <option value="1">HEAD</option>
                                          <option value="2">SPOUSE</option>
                                          <option value="3">SON</option>
                                          <option value="4">DAUGHTER</option>
                                          <option value="5">SON-IN-LAW</option>
                                          <option value="6">DAUGHTER-IN-LAW</option>
                                          <option value="7">GRANDSON</option>
                                          <option value="8">GRANDAUGHTER</option>
                                      </select>
                                          @if ($errors->has('relhh'))
                                              <span id="relhh-error" class="error text-danger" for="input-relhh">{{ $errors->first('relhh') }}</span>
                                          @endif
                                    </div>
                                  </div>
                                </div>
                            </div>
                                
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <dt for="sex" class="col-sm-4 col-form-dt">Sex</dt>
                                    <div class="col-sm-8">
                                      <div class="form-group{{ $errors->has('sex') ? ' has-danger' : '' }}">
                                        <select class="form-control col-lg-12" name="sex">
                                                <option value="{{ $person->sex }}" selected>{{ $person->sex == 1 ? 'MALE' : 'FEMALE' }}</option>
                                                <option value="1">MALE</option>
                                                <option value="2">FEMALE</option>
                                        </select>
                                            @if ($errors->has('sex'))
                                                <span id="sex-error" class="error text-danger" for="input-sex">{{ $errors->first('sex') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <dt for="birthdate" class="col-sm-4 col-form-dt">Birthdate</dt>
                                    <div class="col-sm-8">
                                      <div class="input-group date">
                                        <input class="form-control{{ $errors->has('birthdate') ? ' is-invalid' : '' }}" name="birthdate" id="input-birthdate" type="text" placeholder="{{ __('') }}" value= "{{ \Carbon\Carbon::parse($person->birthdate)->format('Y-m-d') }}" aria-required="true"/>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            @if ($errors->has('birthdate'))
                                                <span name="birthdate-error" class="error text-danger" for="input-birthdate">{{ $errors->first('birthdate') }}</span>
                                            @endif
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <dt for="age" class="col-sm-4 col-form-dt">Age</dt>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="age" value="{{ \Carbon\Carbon::parse($person->birthdate)->age }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <dt for="birthreg" class="col-sm-4 col-form-dt">Birth Registration</dt>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="birthreg" value="{{ $person->birthreg }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                  <dt for="birthreg" class="col-sm-4 col-form-dt">Highest Educational Attainment</dt>
                                  <div class="col-sm-8">
                                    <select class="form-control col-lg-12" name="education" required>
                                            <option selected value="{{ $person->education }}">{{ $education->name }}</option>
                                            <option value="1">NONE</option>
                                            <option value="2">ELEMENTARY - UNFINISHED</option>
                                            <option value="3">ELEMENTARY</option>
                                            <option value="4">SECONDARY - UNFINISHED</option>
                                            <option value="5">SECONDARY</option>
                                            <option value="6">UNDERGRADUATE - UNFINISHED</option>
                                            <option value="7">UNDERGRADUATE</option>
                                            <option value="8">GRADUATE</option>
                                            <option value="9">DOCTORATE</option>
                                    </select>
                                        @if ($errors->has('education'))
                                            <span id="education-error" class="error text-danger" for="input-education">{{ $errors->first('education') }}</span>
                                        @endif
                                  </div>
                                </div>
                            </div>
                        </div>
                          <hr>
                          <label for="Address"><h4>Address</h4></label>
                          <div class="form-group row">
                            <dt for="region" class="col-sm-2 col-form-dt">Region</dt>
                            <div class="col-sm-10">
                                <select class="form-control col-lg-12" name="region" id="region">
                                  <option selected value="{{$person->region}}" >{{$person->region == '60000000' ? 'WESTERN VISAYAS' : ''}}</option>
                                </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <dt for="province" class="col-sm-2 col-form-dt">Province</dt>
                            <div class="col-sm-10">
                                  <select class="form-control col-lg-12 input-province" name="province" id="province">
                                    <option selected value="{{$person->province}}" >{{$province->provname}}</option>
                                    <option value="0604">AKLAN</option>
                                    <option value="0606">ANTIQUE</option>
                                    <option value="0619">CAPIZ</option>
                                    <option value="0679">GUIMARAS</option>
                                    <option value="0630">ILOILO</option>
                                    <option value="0645">NEGROS OCCIDENTAL</option>
                                  </select>
                                    @if ($errors->has('province'))
                                        <span id="province-error" class="error text-danger" for="input-province">{{ $errors->first('province') }}</span>
                                    @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <dt for="municipality" class="col-sm-2 col-form-dt">Municipality/City</dt>
                            <div class="col-sm-10">
                                <select class="form-control col-lg-12 input-mun" name="municipality" id="municipality">
                                  <option value="{{ $person->municipality }}" selected> {{ $municipality->munname }} </option>
                                            {{-- js get municipalities --}}
                                </select>
                                  @if ($errors->has('municipality'))
                                      <span id="municipality-error" class="error text-danger" for="input-municipality">{{ $errors->first('municipality') }}</span>
                                  @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <dt for="barangay" class="col-sm-2 col-form-dt">Barangay</dt>
                            <div class="col-sm-10">
                              <select class="form-control col-lg-12 input-brgy" name="barangay" id="barangay">
                                <option value="{{ $person->barangay }}" selected> {{ $barangay->brgyname }} </option>
                                  {{-- JS get barangays --}}
                              </select>
                                  @if ($errors->has('barangay'))
                                      <span id="barangay-error" class="error text-danger" for="input-barangay">{{ $errors->first('barangay') }}</span>
                                  @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <dt for="sitio" class="col-sm-2 col-form-dt">Sitio</dt>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="sitio" value="{{ $person->sitio }}">
                            </div>
                          </div>
                          <hr>
                          <label for=""><h4>Government Information</h4></label>
                          <div class="form-group row">
                            <dt for="philhealth" class="col-sm-2 col-form-dt">Philhealth No.</dt>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="philhealth" value="{{ $person->philhealth }}">
                            </div>
                          </div>
                          <div class="form-group row">
                            <dt for="household" class="col-sm-2 col-form-dt">DSWD Household No.</dt>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="household" value="{{ $person->household }}">
                            </div>
                          </div>
                          <hr>

                          <label for="ethnicity"><h4>Ethnicity Information</h4></label>
                          <div class="form-group row">
                            <dt for="ethnicity" class="col-sm-2 col-form-dt">Ethnicity</dt>
                            <div class="col-sm-10">
                              <select class="form-control col-lg-12" name="ethnicity_id">
                                  <option selected value="{{ $person->ethnicity_id }}">{{ $ethnicity->name }}</option>
                                  <option value="1">ATI/ATA</option>
                                  <option value="2">BUKIDNON</option>
                                  <option value="3">OTHERS</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group row">
                            <dt for="leader" class="col-sm-2 col-form-dt">Leader</dt>
                            <div class="col-sm-10">
                              <select class="form-control col-lg-12 input-leader" name="leader" id="leader" value="null">
                                  <option selected value="{{$person->leader}}">{{ $person->leader }}</option>
                                  {{-- JS get leaders --}}
                              </select>
                                  @if ($errors->has('leader'))
                                      <span id="leader-error" class="error text-danger" for="input-leader">{{ $errors->first('leader') }}</span>
                                  @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <dt for="head" class="col-sm-2 col-form-dt">Household Head</dt>
                            <div class="col-sm-10">
                              <select class="form-control col-lg-12 input-head" name="head" id="head">
                                  <option selected value="{{ $person->head }}">{{ $person->head }}</option>
                                  {{-- JS get head --}}
                              </select>
                                  @if ($errors->has('head'))
                                      <span id="head-error" class="error text-danger" for="input-head">{{ $errors->first('head') }}</span>
                                  @endif                            </div>
                          </div>
                        <div class="row px-4 py-4 justify-content-between">
                                <button type="submit" class="btn btn-lg btn-success shadow"><i class="fas fa-edit"></i> {{ __('Update') }}</button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection