@extends('layouts.layoutMaster')
@section('title', __('Vehicles | Add new vehicle') )
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
            <li class="breadcrumb-item"><a href="{{ route('vehicles.index') }}">{{ __('Vehicles') }}</a>
            </li>
            <li class="breadcrumb-item active"> {{ $vehicle->id }}
            </li>
        </ol>
    </div>
    @include('_partials.alerts')
    <section>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('vehicles.update' , $vehicle->id ) }}"
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
                                <h5 class="mb-0">{{ __('Vehicles') }}</h5> <small
                                    class="text-muted float-end">.</small>
                            </div>
                  <div class="card-body">










           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicles_plate_number') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("plate_number" , $vehicle->plate_number)  }}" data-placement="left"  data-content="{{ __('vehicles_plate_number_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicles_plate_number_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('plate_number') ? 'is-invalid' : '' }}" name="plate_number" placeholder="{{ __('vehicles_plate_number') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('plate_number'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('plate_number') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicles_serial_number') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("serial_number" , $vehicle->serial_number)  }}" data-placement="left"  data-content="{{ __('vehicles_serial_number_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicles_serial_number_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('serial_number') ? 'is-invalid' : '' }}" name="serial_number" placeholder="{{ __('vehicles_serial_number') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('serial_number'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('serial_number') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicles_chassis_number') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("chassis_number" , $vehicle->chassis_number)  }}" data-placement="left"  data-content="{{ __('vehicles_chassis_number_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicles_chassis_number_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('chassis_number') ? 'is-invalid' : '' }}" name="chassis_number" placeholder="{{ __('vehicles_chassis_number') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('chassis_number'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('chassis_number') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicles_registration_number') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("registration_number" , $vehicle->registration_number)  }}" data-placement="left"  data-content="{{ __('vehicles_registration_number_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicles_registration_number_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('registration_number') ? 'is-invalid' : '' }}" name="registration_number" placeholder="{{ __('vehicles_registration_number') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('registration_number'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('registration_number') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicles_form_expiration') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("form_expiration" , $vehicle->form_expiration)  }}" data-placement="left"  data-content="{{ __('vehicles_form_expiration_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicles_form_expiration_data-original-title') }}"
                                                                     type="date"   class="form-control {{ $errors->has('form_expiration') ? 'is-invalid' : '' }}" name="form_expiration" placeholder="{{ __('vehicles_form_expiration') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('form_expiration'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('form_expiration') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicles_plate_registration_type_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('vehicles_plate_registration_type_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('vehicles_plate_registration_type_id_data-original-title') }}"  class="form-control  {{ $errors->has('plate_registration_type_id') ? 'is-invalid' : '' }} "  name="plate_registration_type_id" >

                            @foreach($plate_registration_types as $plate_registration_type)
                             <option  @selected(old('plate_registration_type_id' , $vehicle->plate_registration_type_id) == $plate_registration_type->id)    value="{{ $plate_registration_type->id }}" >{{ $plate_registration_type->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('plate_registration_type_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('plate_registration_type_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicles_vehicle_manufacturer_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('vehicles_vehicle_manufacturer_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('vehicles_vehicle_manufacturer_id_data-original-title') }}"  class="form-control  {{ $errors->has('vehicle_manufacturer_id') ? 'is-invalid' : '' }} "  name="vehicle_manufacturer_id" >

                            @foreach($vehicle_manufacturers as $vehicle_manufacturer)
                             <option  @selected(old('vehicle_manufacturer_id' , $vehicle->vehicle_manufacturer_id) == $vehicle_manufacturer->id)    value="{{ $vehicle_manufacturer->id }}" >{{ $vehicle_manufacturer->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('vehicle_manufacturer_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('vehicle_manufacturer_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicles_vehicle_manufacturer_year') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("vehicle_manufacturer_year" , $vehicle->vehicle_manufacturer_year)  }}" data-placement="left"  data-content="{{ __('vehicles_vehicle_manufacturer_year_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicles_vehicle_manufacturer_year_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('vehicle_manufacturer_year') ? 'is-invalid' : '' }}" name="vehicle_manufacturer_year" placeholder="{{ __('vehicles_vehicle_manufacturer_year') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('vehicle_manufacturer_year'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('vehicle_manufacturer_year') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicles_vehicle_model_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('vehicles_vehicle_model_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('vehicles_vehicle_model_id_data-original-title') }}"  class="form-control  {{ $errors->has('vehicle_model_id') ? 'is-invalid' : '' }} "  name="vehicle_model_id" >

                            @foreach($vehicle_models as $vehicle_model)
                             <option  @selected(old('vehicle_model_id' , $vehicle->vehicle_model_id) == $vehicle_model->id)    value="{{ $vehicle_model->id }}" >{{ $vehicle_model->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('vehicle_model_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('vehicle_model_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicles_vehicle_color_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('vehicles_vehicle_color_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('vehicles_vehicle_color_id_data-original-title') }}"  class="form-control  {{ $errors->has('vehicle_color_id') ? 'is-invalid' : '' }} "  name="vehicle_color_id" >

                            @foreach($vehicle_colors as $vehicle_color)
                             <option  @selected(old('vehicle_color_id' , $vehicle->vehicle_color_id) == $vehicle_color->id)    value="{{ $vehicle_color->id }}" >{{ $vehicle_color->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('vehicle_color_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('vehicle_color_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicles_vehicle_status_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('vehicles_vehicle_status_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('vehicles_vehicle_status_id_data-original-title') }}"  class="form-control  {{ $errors->has('vehicle_status_id') ? 'is-invalid' : '' }} "  name="vehicle_status_id" >

                            @foreach($vehicle_statuses as $vehicle_status)
                             <option  @selected(old('vehicle_status_id' , $vehicle->vehicle_status_id) == $vehicle_status->id)    value="{{ $vehicle_status->id }}" >{{ $vehicle_status->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('vehicle_status_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('vehicle_status_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicles_vehicle_type_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('vehicles_vehicle_type_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('vehicles_vehicle_type_id_data-original-title') }}"  class="form-control  {{ $errors->has('vehicle_type_id') ? 'is-invalid' : '' }} "  name="vehicle_type_id" >

                            @foreach($vehicle_types as $vehicle_type)
                             <option  @selected(old('vehicle_type_id' , $vehicle->vehicle_type_id) == $vehicle_type->id)    value="{{ $vehicle_type->id }}" >{{ $vehicle_type->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('vehicle_type_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('vehicle_type_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicles_vehicle_supplier_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('vehicles_vehicle_supplier_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('vehicles_vehicle_supplier_id_data-original-title') }}"  class="form-control  {{ $errors->has('vehicle_supplier_id') ? 'is-invalid' : '' }} "  name="vehicle_supplier_id" >

                            @foreach($vehicle_suppliers as $vehicle_supplier)
                             <option  @selected(old('vehicle_supplier_id' , $vehicle->vehicle_supplier_id) == $vehicle_supplier->id)    value="{{ $vehicle_supplier->id }}" >{{ $vehicle_supplier->supplier_name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('vehicle_supplier_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('vehicle_supplier_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicles_ownership_date') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("ownership_date" , $vehicle->ownership_date)  }}" data-placement="left"  data-content="{{ __('vehicles_ownership_date_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicles_ownership_date_data-original-title') }}"
                                                                     type="date"   class="form-control {{ $errors->has('ownership_date') ? 'is-invalid' : '' }}" name="ownership_date" placeholder="{{ __('vehicles_ownership_date') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('ownership_date'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('ownership_date') }}
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
