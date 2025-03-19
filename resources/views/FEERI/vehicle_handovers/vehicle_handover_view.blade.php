@extends('layouts.layoutMaster')
@section('title', __('Vehicle_handovers | Add new vehicle_handover') )
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
            <li class="breadcrumb-item"><a href="{{ route('vehicle_handovers.index') }}">{{ __('Vehicle_handovers') }}</a>
            </li>
            <li class="breadcrumb-item active"> {{ $vehicle_handover->id }}
            </li>
        </ol>
    </div>
    @include('_partials.alerts')
    <section>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('vehicle_handovers.update' , $vehicle_handover->id ) }}"
            enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')
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
                                <h5 class="mb-0">{{ __('Vehicle_handovers') }}</h5> <small
                                    class="text-muted float-end">.</small>
                            </div>
                  <div class="card-body">










 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_handovers_driver_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('vehicle_handovers_driver_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('vehicle_handovers_driver_id_data-original-title') }}"  class="form-control  {{ $errors->has('driver_id') ? 'is-invalid' : '' }} "  name="driver_id" >

                            @foreach($drivers as $driver)
                             <option  @selected(old('driver_id' , $vehicle_handover->driver_id) == $driver->id)    value="{{ $driver->id }}" >{{ $driver->full_name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('driver_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('driver_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_handovers_vehicle_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('vehicle_handovers_vehicle_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('vehicle_handovers_vehicle_id_data-original-title') }}"  class="form-control  {{ $errors->has('vehicle_id') ? 'is-invalid' : '' }} "  name="vehicle_id" >

                            @foreach($vehicles as $vehicle)
                             <option  @selected(old('vehicle_id' , $vehicle_handover->vehicle_id) == $vehicle->id)    value="{{ $vehicle->id }}" >{{ $vehicle->plate_number }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('vehicle_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('vehicle_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_handovers_meter_upon_handover') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("meter_upon_handover" , $vehicle_handover->meter_upon_handover)  }}" data-placement="left"  data-content="{{ __('vehicle_handovers_meter_upon_handover_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_handovers_meter_upon_handover_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('meter_upon_handover') ? 'is-invalid' : '' }}" name="meter_upon_handover" placeholder="{{ __('vehicle_handovers_meter_upon_handover') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('meter_upon_handover'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('meter_upon_handover') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_handovers_authorization_start_date') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("authorization_start_date" , $vehicle_handover->authorization_start_date)  }}" data-placement="left"  data-content="{{ __('vehicle_handovers_authorization_start_date_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_handovers_authorization_start_date_data-original-title') }}"
                                                                     type="date"   class="form-control {{ $errors->has('authorization_start_date') ? 'is-invalid' : '' }}" name="authorization_start_date" placeholder="{{ __('vehicle_handovers_authorization_start_date') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('authorization_start_date'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('authorization_start_date') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_handovers_authorization_end_date') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("authorization_end_date" , $vehicle_handover->authorization_end_date)  }}" data-placement="left"  data-content="{{ __('vehicle_handovers_authorization_end_date_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_handovers_authorization_end_date_data-original-title') }}"
                                                                     type="date"   class="form-control {{ $errors->has('authorization_end_date') ? 'is-invalid' : '' }}" name="authorization_end_date" placeholder="{{ __('vehicle_handovers_authorization_end_date') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('authorization_end_date'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('authorization_end_date') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_handovers_front_right_image') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("front_right_image" , $vehicle_handover->front_right_image)  }}" data-placement="left"  data-content="{{ __('vehicle_handovers_front_right_image_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_handovers_front_right_image_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('front_right_image') ? 'is-invalid' : '' }}" name="front_right_image" placeholder="{{ __('vehicle_handovers_front_right_image') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('front_right_image'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('front_right_image') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_handovers_back_left_image') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("back_left_image" , $vehicle_handover->back_left_image)  }}" data-placement="left"  data-content="{{ __('vehicle_handovers_back_left_image_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_handovers_back_left_image_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('back_left_image') ? 'is-invalid' : '' }}" name="back_left_image" placeholder="{{ __('vehicle_handovers_back_left_image') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('back_left_image'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('back_left_image') }}
                                                </div>
                                                @endif
                                                                </div>
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
