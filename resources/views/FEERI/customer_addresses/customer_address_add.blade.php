@extends('layouts.layoutMaster')
@section('title', __('Customer_addresses | Add new customer_address') )
@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endsection
@section('vendor-script')
<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
@endsection
@section('page-script')
<script src="{{asset('assets/js/form-layouts.js')}}"></script>
@endsection
@section('content')
  <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('customer_addresses.index') }}">{{ __('Customer_addresses') }}</a>
            </li>
            <li class="breadcrumb-item active"> {{ __('Add new customer_address') }}
            </li>
        </ol>
    </div>
    @include('_partials.alerts')
    <section>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('customer_addresses.store') }}"
            enctype="multipart/form-data" novalidate>
            @csrf
            <div class="row justify-content-end">
                <div class="col-sm-4">
                    <button type="reset" class="btn btn-outline-warning">{{ __('Reset') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-10 col-sm-12">
                <div class="card h-100 mb-4">
                  <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">{{ __('Customer_addresses') }}</h5> <small
                                    class="text-muted float-end">.</small>
                            </div>
                  <div class="card-body">



           <div class="col-12  mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('customer_addresses_user_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select   data-toggle="popover"   data-placement="left"  data-content="{{ __('customer_addresses_user_id_data-content') }}" data-trigger="hover"  data-original-title="{{ __('customer_addresses_user_id_data-original-title') }}"  class="form-control {{ $errors->has('user_id') ? 'is-invalid' : '' }}"     data-validation-required-message="{{ __('This field is required') }}" name="user_id" >

                            @foreach($users as $user)
                             <option  @selected(old('user_id' ) == $user->id)   value="{{ $user->id }}" >{{ $user->first_name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('user_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('user_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12  mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('customer_addresses_country_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select   data-toggle="popover"   data-placement="left"  data-content="{{ __('customer_addresses_country_id_data-content') }}" data-trigger="hover"  data-original-title="{{ __('customer_addresses_country_id_data-original-title') }}"  class="form-control {{ $errors->has('country_id') ? 'is-invalid' : '' }}"     data-validation-required-message="{{ __('This field is required') }}" name="country_id" >

                            @foreach($countries as $country)
                             <option  @selected(old('country_id' ) == $country->id)   value="{{ $country->id }}" >{{ $country->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('country_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('country_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12  mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('customer_addresses_city_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select   data-toggle="popover"   data-placement="left"  data-content="{{ __('customer_addresses_city_id_data-content') }}" data-trigger="hover"  data-original-title="{{ __('customer_addresses_city_id_data-original-title') }}"  class="form-control {{ $errors->has('city_id') ? 'is-invalid' : '' }}"     data-validation-required-message="{{ __('This field is required') }}" name="city_id" >

                            @foreach($cities as $city)
                             <option  @selected(old('city_id' ) == $city->id)   value="{{ $city->id }}" >{{ $city->country_id }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('city_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('city_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12  mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('customer_addresses_neighbourhood_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select   data-toggle="popover"   data-placement="left"  data-content="{{ __('customer_addresses_neighbourhood_id_data-content') }}" data-trigger="hover"  data-original-title="{{ __('customer_addresses_neighbourhood_id_data-original-title') }}"  class="form-control {{ $errors->has('neighbourhood_id') ? 'is-invalid' : '' }}"     data-validation-required-message="{{ __('This field is required') }}" name="neighbourhood_id" >

                            @foreach($neighbourhoods as $neighbourhood)
                             <option  @selected(old('neighbourhood_id' ) == $neighbourhood->id)   value="{{ $neighbourhood->id }}" >{{ $neighbourhood->city_id }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('neighbourhood_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('neighbourhood_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
 



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('customer_addresses_location_lat') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{  old('location_lat')   }}" data-placement="left"  data-content="{{ __('customer_addresses_location_lat_data-content') }}" data-trigger="hover"  data-original-title="{{ __('customer_addresses_location_lat_data-original-title') }}" 
                                                                     type="text"   class="form-control {{ $errors->has('location_lat') ? 'is-invalid' : '' }}" name="location_lat" placeholder="{{ __('customer_addresses_location_lat') }}" data-validation-required-message="{{ __('This field is required') }}" >
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('location_lat'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('location_lat') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    

      



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('customer_addresses_location_lanf') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{  old('location_lanf')   }}" data-placement="left"  data-content="{{ __('customer_addresses_location_lanf_data-content') }}" data-trigger="hover"  data-original-title="{{ __('customer_addresses_location_lanf_data-original-title') }}" 
                                                                     type="text"   class="form-control {{ $errors->has('location_lanf') ? 'is-invalid' : '' }}" name="location_lanf" placeholder="{{ __('customer_addresses_location_lanf') }}" data-validation-required-message="{{ __('This field is required') }}" >
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('location_lanf'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('location_lanf') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    

      



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('customer_addresses_zip_code') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{  old('zip_code')   }}" data-placement="left"  data-content="{{ __('customer_addresses_zip_code_data-content') }}" data-trigger="hover"  data-original-title="{{ __('customer_addresses_zip_code_data-original-title') }}" 
                                                                     type="text"   class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}" name="zip_code" placeholder="{{ __('customer_addresses_zip_code') }}" data-validation-required-message="{{ __('This field is required') }}" >
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('zip_code'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('zip_code') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    

     






       <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('customer_addresses_address') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <textarea  data-toggle="popover"   data-placement="left"  data-content="{{ __('customer_addresses_address_data-content') }}" data-trigger="hover"  data-original-title="{{ __('customer_addresses_address_data-original-title') }}"    class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" placeholder="{{ __('customer_addresses_address') }}"   >{{ old('address') }}</textarea>
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-text"></i>
                                                                    </div>


                                @if ($errors->has('address'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('address') }}
                                                </div>
                                              @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
<div class="col-12 mb-3">
  <div class="form-group row">
    <div class="col-md-4">
      <span>@lang('customer_addresses_is_default') </span>
    </div>
    <div class="col-md-8">
      <label class="switch">
        <input name="is_default" value="1" @checked(old('is_default') == 1) type="checkbox" id="is_default" class="switch-input">
        <span class="switch-toggle-slider">
          <span class="switch-on"></span>
          <span class="switch-off"></span>
        </span>
        <span class="switch-label"></span>
      </label>
      @if ($errors->has('is_default'))
      <div class="invalid-feedback">
        {{ $errors->first('is_default') }}
      </div>
      @endif
    </div>
  </div>
</div>



                  </div>
                </div>


                </div>
                <div class="col-md-2 col-sm-12">



                </div>
            </div>
            <div class="row justify-content-end mt-3">
                <div class="col-sm-4">
                    <button type="reset" class="btn btn-outline-warning">{{ __('Reset') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </div>
        </form>
    </section>



@endsection
