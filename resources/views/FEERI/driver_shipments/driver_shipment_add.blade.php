@extends('layouts.layoutMaster')
@section('title', __('Driver_shipments | Add new driver_shipment') )
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
            <li class="breadcrumb-item"><a href="{{ route('driver_shipments.index') }}">{{ __('Driver_shipments') }}</a>
            </li>
            <li class="breadcrumb-item active"> {{ __('Add new driver_shipment') }}
            </li>
        </ol>
    </div>
    @include('_partials.alerts')
    <section>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('driver_shipments.store') }}"
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
                                <h5 class="mb-0">{{ __('Driver_shipments') }}</h5> <small
                                    class="text-muted float-end">.</small>
                            </div>
                  <div class="card-body">



           <div class="col-12  mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('driver_shipments_project_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select   data-toggle="popover"   data-placement="left"  data-content="{{ __('driver_shipments_project_id_data-content') }}" data-trigger="hover"  data-original-title="{{ __('driver_shipments_project_id_data-original-title') }}"  class="form-control {{ $errors->has('project_id') ? 'is-invalid' : '' }}"     data-validation-required-message="{{ __('This field is required') }}" name="project_id" >

                            @foreach($projects as $project)
                             <option  @selected(old('project_id' ) == $project->id)   value="{{ $project->id }}" >{{ $project->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('project_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('project_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12  mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('driver_shipments_driver_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select   data-toggle="popover"   data-placement="left"  data-content="{{ __('driver_shipments_driver_id_data-content') }}" data-trigger="hover"  data-original-title="{{ __('driver_shipments_driver_id_data-original-title') }}"  class="form-control {{ $errors->has('driver_id') ? 'is-invalid' : '' }}"     data-validation-required-message="{{ __('This field is required') }}" name="driver_id" >

                            @foreach($drivers as $driver)
                             <option  @selected(old('driver_id' ) == $driver->id)   value="{{ $driver->id }}" >{{ $driver->full_name }}</option>
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
                                                                <span>{{ __('driver_shipments_total_orders') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{  old('total_orders')   }}" data-placement="left"  data-content="{{ __('driver_shipments_total_orders_data-content') }}" data-trigger="hover"  data-original-title="{{ __('driver_shipments_total_orders_data-original-title') }}" 
                                                                     type="number"   class="form-control {{ $errors->has('total_orders') ? 'is-invalid' : '' }}" name="total_orders" placeholder="{{ __('driver_shipments_total_orders') }}" data-validation-required-message="{{ __('This field is required') }}" >
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('total_orders'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('total_orders') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    

      



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('driver_shipments_delivered_orders') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{  old('delivered_orders')   }}" data-placement="left"  data-content="{{ __('driver_shipments_delivered_orders_data-content') }}" data-trigger="hover"  data-original-title="{{ __('driver_shipments_delivered_orders_data-original-title') }}" 
                                                                     type="number"   class="form-control {{ $errors->has('delivered_orders') ? 'is-invalid' : '' }}" name="delivered_orders" placeholder="{{ __('driver_shipments_delivered_orders') }}" data-validation-required-message="{{ __('This field is required') }}" >
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('delivered_orders'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('delivered_orders') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    

      



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('driver_shipments_not_delivered_orders') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{  old('not_delivered_orders')   }}" data-placement="left"  data-content="{{ __('driver_shipments_not_delivered_orders_data-content') }}" data-trigger="hover"  data-original-title="{{ __('driver_shipments_not_delivered_orders_data-original-title') }}" 
                                                                     type="number"   class="form-control {{ $errors->has('not_delivered_orders') ? 'is-invalid' : '' }}" name="not_delivered_orders" placeholder="{{ __('driver_shipments_not_delivered_orders') }}" data-validation-required-message="{{ __('This field is required') }}" >
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('not_delivered_orders'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('not_delivered_orders') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    

     






       <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('driver_shipments_return_reasons') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <textarea  data-toggle="popover"   data-placement="left"  data-content="{{ __('driver_shipments_return_reasons_data-content') }}" data-trigger="hover"  data-original-title="{{ __('driver_shipments_return_reasons_data-original-title') }}"    class="form-control {{ $errors->has('return_reasons') ? 'is-invalid' : '' }}" name="return_reasons" placeholder="{{ __('driver_shipments_return_reasons') }}"   >{{ old('return_reasons') }}</textarea>
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-text"></i>
                                                                    </div>


                                @if ($errors->has('return_reasons'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('return_reasons') }}
                                                </div>
                                              @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
 



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('driver_shipments_orders_date') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{  old('orders_date')   }}" data-placement="left"  data-content="{{ __('driver_shipments_orders_date_data-content') }}" data-trigger="hover"  data-original-title="{{ __('driver_shipments_orders_date_data-original-title') }}" 
                                                                     type="date"   class="form-control {{ $errors->has('orders_date') ? 'is-invalid' : '' }}" name="orders_date" placeholder="{{ __('driver_shipments_orders_date') }}" data-validation-required-message="{{ __('This field is required') }}" >
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('orders_date'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('orders_date') }}
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
