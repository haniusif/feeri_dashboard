@extends('layouts.layoutMaster')
@section('title', __('Vehicle_suppliers | Add new vehicle_supplier') )
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
            <li class="breadcrumb-item"><a href="{{ route('vehicle_suppliers.index') }}">{{ __('Vehicle_suppliers') }}</a>
            </li>
            <li class="breadcrumb-item active"> {{ __('Add new vehicle_supplier') }}
            </li>
        </ol>
    </div>
    @include('_partials.alerts')
    <section>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('vehicle_suppliers.store') }}"
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
                                <h5 class="mb-0">{{ __('Vehicle_suppliers') }}</h5> <small
                                    class="text-muted float-end">.</small>
                            </div>
                  <div class="card-body">
 



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_suppliers_supplier_name') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{  old('supplier_name')   }}" data-placement="left"  data-content="{{ __('vehicle_suppliers_supplier_name_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_suppliers_supplier_name_data-original-title') }}" 
                                                                     type="text"   class="form-control {{ $errors->has('supplier_name') ? 'is-invalid' : '' }}" name="supplier_name" placeholder="{{ __('vehicle_suppliers_supplier_name') }}" data-validation-required-message="{{ __('This field is required') }}" >
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('supplier_name'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('supplier_name') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    

     


           <div class="col-12  mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_suppliers_id_type_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select   data-toggle="popover"   data-placement="left"  data-content="{{ __('vehicle_suppliers_id_type_id_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_suppliers_id_type_id_data-original-title') }}"  class="form-control {{ $errors->has('id_type_id') ? 'is-invalid' : '' }}"     data-validation-required-message="{{ __('This field is required') }}" name="id_type_id" >

                            @foreach($id_types as $id_type)
                             <option  @selected(old('id_type_id' ) == $id_type->id)   value="{{ $id_type->id }}" >{{ $id_type->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('id_type_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('id_type_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
 



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_suppliers_id_number') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{  old('id_number')   }}" data-placement="left"  data-content="{{ __('vehicle_suppliers_id_number_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_suppliers_id_number_data-original-title') }}" 
                                                                     type="text"   class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" name="id_number" placeholder="{{ __('vehicle_suppliers_id_number') }}" data-validation-required-message="{{ __('This field is required') }}" >
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('id_number'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('id_number') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    

     



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_suppliers_id_image') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{  old('id_image')   }}" data-placement="left"  data-content="{{ __('vehicle_suppliers_id_image_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_suppliers_id_image_data-original-title') }}"
                                                                     type="file"   class="form-control {{ $errors->has('id_image') ? 'is-invalid' : '' }}" name="id_image" placeholder="{{ __('vehicle_suppliers_id_image') }}" data-validation-required-message="{{ __('This field is required') }}" >
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-image"></i>
                                                                    </div>

                                                                    @if ($errors->has('id_image'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('id_image') }}
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
