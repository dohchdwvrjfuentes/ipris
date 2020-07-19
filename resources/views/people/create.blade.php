@extends('layouts.app', ['titlePage' => __('Create - Indigenous Peoples Registry System')])

@section('content')
@php
    use Illuminate\Support\Facades\DB;
    
    $province = DB::table('province')->where('provcode', Auth::user()->area)->first();

@endphp
<div class="container px-4">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card px-4 shadow-sm">
                <div class="card-body pb-0">
                    <ul class="nav justify-content-between">
                        <span class="nav-item text-left"><h4 class="card-title text-left"><i class="fas fa-user-plus"></i> {{ __('New Data') }}</h4></span>
                        <div class="form-inline">
                            <li class="nav-item p-1"><a href="{{ route('home') }}" class="btn btn btn-danger shadow-sm"><i class="far fa-arrow-alt-circle-left"></i> {{ __('Return Home') }}</a></li>
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

                </div>
                <hr>
            <form method="POST" action="{{ route('person.store') }}">

                @csrf

                <div class="row justify-content-center py-4">
                    <div class="col-lg-12">
                        <label for="Government" class="col-lg-12"><h4>Government Information</h4></label>
                        <div class="form-row">
                            <div class="col-lg-3">
                                <label for="Philhealth">Philhealth No.</label>
                                <div class="form-group{{ $errors->has('philhealth') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('philhealth') ? ' is-invalid' : '' }}" name="philhealth" id="input-philhealth" type="text" placeholder="{{ __('') }}" value= "{{old('philhealth', 'N/A')}}" aria-required="true" onkeyup="this.value = this.value.toUpperCase();"/>
                                        @if ($errors->has('philhealth'))
                                          <span id="philhealth-error" class="error text-danger" for="input-philhealth">{{ $errors->first('philhealth') }}</span>
                                        @endif
                                </div>   
                            </div>
                            <div class="col-lg-3">
                                <label for="Household">Household No.</label>
                                <div class="form-group{{ $errors->has('household') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('household') ? ' is-invalid' : '' }}" name="household" id="input-household" type="text" placeholder="{{ __('') }}" value= "{{old('household', 'N/A')}}" aria-required="true" onkeyup="this.value = this.value.toUpperCase();"/>
                                        @if ($errors->has('household'))
                                            <span id="household-error" class="error text-danger" for="input-household">{{ $errors->first('household') }}</span>
                                        @endif
                                </div>   
                            </div>   
                        </div>
                    <hr>
                        <label for="Personal" class="col-lg-12"><h4>Personal Information</h4></label>
                        <div class="form-row">
                            <div class="col-lg-3">
                                <label for="FamilyName">Family Name <i class="fas fa-asterisk fa-xs text-danger"></i></label>
                                <div class="form-group{{ $errors->has('surname') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" required name="surname" id="input-surname" type="text" placeholder="{{ __('') }}" value= "{{old('surname', 'N/A')}}" aria-required="true" onkeyup="this.value = this.value.toUpperCase();"/>
                                        @if ($errors->has('surname'))
                                        <span id="surname-error" class="error text-danger" for="input-surname">{{ $errors->first('surname') }}</span>
                                        @endif
                                </div>   
                            </div>
                            <div class="col-lg-3">
                                <label for="FirstName">First Name <i class="fas fa-asterisk fa-xs text-danger"></i></label>
                                <div class="form-group{{ $errors->has('firstname') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" required name="firstname" id="input-firstname" type="text" placeholder="{{ __('') }}" value= "{{old('firstname', 'N/A')}}" aria-required="true" onkeyup="this.value = this.value.toUpperCase();"/>
                                        @if ($errors->has('firstname'))
                                            <span id="firstname-error" class="error text-danger" for="input-firstname">{{ $errors->first('firstname') }}</span>
                                        @endif
                                </div>   
                            </div> 
                            <div class="col-lg-3">
                                <label for="MiddleName">Middle Name</label>
                                <div class="form-group{{ $errors->has('middlename') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('middlename') ? ' is-invalid' : '' }}" name="middlename" id="input-middlename" type="text" placeholder="{{ __('') }}" value= "{{old('middlename', 'N/A')}}" aria-required="true" onkeyup="this.value = this.value.toUpperCase();"/>
                                        @if ($errors->has('middlename'))
                                            <span id="middlename-error" class="error text-danger" for="input-middlename">{{ $errors->first('middlename') }}</span>
                                        @endif
                                </div>   
                            </div>
                            <div class="col-lg-2">
                                <label for="ExtensionName">Extension</label>
                                <div class="form-group{{ $errors->has('extension') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('extension') ? ' is-invalid' : '' }}" name="extension" id="input-extension" type="text" placeholder="{{ __('') }}" value= "{{old('extension', 'N/A')}}" aria-required="true" onkeyup="this.value = this.value.toUpperCase();"/>
                                        @if ($errors->has('extension'))
                                            <span id="extension-error" class="error text-danger" for="input-extension">{{ $errors->first('extension') }}</span>
                                        @endif
                                </div>   
                            </div>                   
                        </div>
                        <div class="form-row">
                            <div class="col-lg-3">
                                <label for="Sex">Sex <i class="fas fa-asterisk fa-xs text-danger"></i></label>
                                <div class="form-group{{ $errors->has('sex') ? ' has-danger' : '' }}">
                                    <select class="form-control col-lg-12" name="sex" required>
                                            <option disabled selected>SELECT</option>
                                            <option value="1">MALE</option>
                                            <option value="2">FEMALE</option>
                                    </select>
                                        @if ($errors->has('sex'))
                                            <span id="sex-error" class="error text-danger" for="input-sex">{{ $errors->first('sex') }}</span>
                                        @endif
                                </div>   
                            </div>                 
                        </div>
                        <div class="form-row">
                            <div class="col-lg-3">
                                <label for="Birthdate">Birthdate</label>
                                <div class="form-group{{ $errors->has('birthdate') ? ' has-danger' : '' }}">
                                    <div class="input-group date">
                                        <input class="form-control{{ $errors->has('birthdate') ? ' is-invalid' : '' }}" name="birthdate" id="input-birthdate" type="text" placeholder="{{ __('') }}" value= "{{old('birthdate')}}" aria-required="true"/>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            @if ($errors->has('birthdate'))
                                                <span id="birthdate-error" class="error text-danger" for="input-birthdate">{{ $errors->first('birthdate') }}</span>
                                            @endif
                                    </div>
                                </div>   
                            </div>
                            <div class="col-lg-3">
                                <label for="Age">Age <i class="fas fa-asterisk fa-xs text-danger"></i></label>
                                <div class="form-group{{ $errors->has('age') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" required name="age" id="input-age" type="text" placeholder="{{ __('') }}" value= "{{old('age')}}" aria-required="true" onkeyup="this.value = this.value.toUpperCase();"/>
                                        @if ($errors->has('age'))
                                            <span id="age-error" class="error text-danger" for="input-age">{{ $errors->first('age') }}</span>
                                        @endif
                                </div>   
                            </div>  
                            <div class="col-lg-3">
                                <label for="BirthRegistration">Birth Registration </label>
                                <div class="form-group{{ $errors->has('birthreg') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('birthreg') ? ' is-invalid' : '' }}" name="birthreg" id="input-birthreg" type="text" placeholder="{{ __('') }}" value= "{{old('birthreg', 'N/A')}}" aria-required="true" onkeyup="this.value = this.value.toUpperCase();"/>
                                        @if ($errors->has('birthreg'))
                                            <span id="birthreg-error" class="error text-danger" for="input-birthreg">{{ $errors->first('birthreg') }}</span>
                                        @endif
                                </div>   
                            </div>                    
                        </div>
                        <div class="form-row">
                            <div class="col-lg-4">
                                <label for="Education">Highest Educational Attainment <i class="fas fa-asterisk fa-xs text-danger"></i></label>
                               <div class="form-group{{ $errors->has('education') ? ' has-danger' : '' }}">
                                    <select class="form-control col-lg-12" name="education" required>
                                            <option disabled selected>SELECT</option>
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
                    <hr>
                        <label for="Address" class="col-lg-12"><h4>Address</h4></label>
                        <div class="form-row">
                            <div class="col-lg-3">
                                <label for="Province">Province <i class="fas fa-asterisk fa-xs text-danger"></i></label>
                                <div class="form-group{{ $errors->has('province') ? ' has-danger' : '' }}">
                                    <select class="form-control col-lg-12 input-province" name="province" id="province" required>
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
                                        @if ($errors->has('province'))
                                            <span id="province-error" class="error text-danger" for="input-province">{{ $errors->first('province') }}</span>
                                        @endif
                                </div>   
                            </div>
                            <div class="col-lg-3">
                                <label for="Municipality">Municipality <i class="fas fa-asterisk fa-xs text-danger"></i></label>
                                <div class="form-group{{ $errors->has('municipality') ? ' has-danger' : '' }}">
                                    <select class="form-control col-lg-12 input-mun" name="municipality" id="municipality" required>
                                            {{-- js get municipalities --}}
                                    </select>
                                        @if ($errors->has('municipality'))
                                            <span id="municipality-error" class="error text-danger" for="input-municipality">{{ $errors->first('municipality') }}</span>
                                        @endif
                                </div>   
                            </div>  
                            <div class="col-lg-3">
                                <label for="Barangay">Barangay <i class="fas fa-asterisk fa-xs text-danger"></i></label>
                                <div class="form-group{{ $errors->has('barangay') ? ' has-danger' : '' }}">
                                    <select class="form-control col-lg-12 input-brgy" name="barangay" id="barangay" required>
                                        {{-- JS get barangays --}}
                                    </select>
                                        @if ($errors->has('barangay'))
                                            <span id="barangay-error" class="error text-danger" for="input-barangay">{{ $errors->first('barangay') }}</span>
                                        @endif
                                </div>   
                            </div>
                            <div class="col-lg-3">
                                <label for="Sitio">Sitio</label>
                                <div class="form-group{{ $errors->has('sitio') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('sitio') ? ' is-invalid' : '' }}" name="sitio" id="input-sitio" type="text" placeholder="{{ __('') }}" value= "{{old('sitio', 'N/A')}}" aria-required="true" onkeyup="this.value = this.value.toUpperCase();"/>
                                        @if ($errors->has('sitio'))
                                            <span id="sitio-error" class="error text-danger" for="input-sitio">{{ $errors->first('sitio') }}</span>
                                        @endif
                                </div>   
                            </div>
                        </div>
                        <hr>
                        <label for="Ethnicity" class="col-lg-12"><h4>Ethnicity & Other Information</h4></label>
                        <div class="form-row">
                            <div class="col-lg-3">
                                <label for="Ethnicity">Ethnicity <i class="fas fa-asterisk fa-xs text-danger"></i></label>
                                <div class="form-group{{ $errors->has('ethnicity') ? ' has-danger' : '' }}">
                                    <select class="form-control col-lg-12" name="ethnicity" required>
                                            <option disabled selected>SELECT</option>
                                            <option value="1">ATI/ATA</option>
                                            <option value="2">BUKIDNON</option>
                                            <option value="3">OTHERS</option>
                                    </select>
                                        @if ($errors->has('ethnicity'))
                                            <span id="ethnicity-error" class="error text-danger" for="input-ethnicity">{{ $errors->first('ethnicity') }}</span>
                                        @endif
                                </div>   
                            </div>
                            <div class="col-lg-5">
                                <label for="Leader">Leader</label>
                                <div class="form-group{{ $errors->has('leader') ? ' has-danger' : '' }}">
                                    <select class="form-control col-lg-12 input-leader" name="leader" id="leader" value="null">
                                        {{-- JS get leaders --}}
                                    </select>
                                        @if ($errors->has('leader'))
                                            <span id="leader-error" class="error text-danger" for="input-leader">{{ $errors->first('leader') }}</span>
                                        @endif
                                </div>   
                            </div>
                            <div class="col-lg-4">
                                <label for="Leader">Mark as Leader</label>
                                <div class="form-check px-4 col-lg-12">
                                    <input class="form-check-input" type="radio" name="isLeader" id="isLeader1" value="1">
                                    <label class="form-check-label" for="isLeader1">
                                      Yes
                                    </label>
                                </div>
                                <div class="form-check px-4 col-lg-12">
                                    <input class="form-check-input" type="radio" name="isLeader" id="isLeader2" value="2" checked>
                                    <label class="form-check-label" for="isLeader2">
                                      No
                                    </label>
                                </div>   
                            </div>               
                        </div>
                        <div class="form-row">
                            <div class="col-lg-3">
                                <label for="Head">Head</label>
                                <div class="form-group{{ $errors->has('head') ? ' has-danger' : '' }}">
                                    <select class="form-control col-lg-12 input-head" name="head" id="head">
                                        {{-- JS get head --}}
                                    </select>
                                        @if ($errors->has('head'))
                                            <span id="head-error" class="error text-danger" for="input-head">{{ $errors->first('head') }}</span>
                                        @endif
                                </div>   
                            </div>
                            <div class="col-lg-3">
                                <label for="relhh">Relation to Household</label>
                                <div class="form-group{{ $errors->has('relhh') ? ' has-danger' : '' }}">
                                    <select class="form-control col-lg-12" name="relhh" required>
                                            <option disabled selected>SELECT</option>
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
                            <div class="col-lg-3">
                                <label for="isIP">Mark as IP</label>
                                <div class="form-check px-4 col-lg-12">
                                    <input class="form-check-input" type="radio" checked name="isIP" id="isIP1" value="1">
                                    <label class="form-check-label" for="isIP1">
                                      Yes
                                    </label>
                                </div>
                                <div class="form-check px-4 col-lg-12">
                                    <input class="form-check-input" type="radio" name="isIP" id="isIP2" value="2">
                                    <label class="form-check-label" for="isIP2">
                                      No
                                    </label>
                                </div>   
                            </div>                
                        </div>     
                    </div> <!--COLUMN -->
                </div> <!--ROW-->
                <div class="row px-4 py-4 justify-content-between">
                        <button type="submit" class="btn btn-lg btn-success shadow"><i class="fas fa-plus-square"></i> {{ __('Insert') }}</button>
                </div>
            </form> <!--FORM-->
            </div>
        </div>
    </div>
</div>
<script>
    
</script>
@endsection