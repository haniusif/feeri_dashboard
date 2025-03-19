@extends('layouts.layoutMaster')
@section('title', __('Order_packages | Add new order_package') )
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
            <li class="breadcrumb-item"><a href="{{ route('order_packages.index') }}">{{ __('Order_packages') }}</a>
            </li>
            <li class="breadcrumb-item active"> {{ $order_package->id }}
            </li>
        </ol>
    </div>
    @include('_partials.alerts')
    <section>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('order_packages.update' , $order_package->id ) }}"
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
                                <h5 class="mb-0">{{ __('Order_packages') }}</h5> <small
                                    class="text-muted float-end">.</small>
                            </div>
                  <div class="card-body">










 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_order_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('order_packages_order_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('order_packages_order_id_data-original-title') }}"  class="form-control  {{ $errors->has('order_id') ? 'is-invalid' : '' }} "  name="order_id" >

                            @foreach($orders as $order)
                             <option  @selected(old('order_id' , $order_package->order_id) == $order->id)    value="{{ $order->id }}" >{{ $order->order_reference }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('order_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('order_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_package_name') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("package_name" , $order_package->package_name)  }}" data-placement="left"  data-content="{{ __('order_packages_package_name_data-content') }}" data-trigger="hover"  data-original-title="{{ __('order_packages_package_name_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('package_name') ? 'is-invalid' : '' }}" name="package_name" placeholder="{{ __('order_packages_package_name') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('package_name'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('package_name') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>






       <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_package_description') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <textarea  data-toggle="popover"   data-placement="left"  data-content="{{ __('order_packages_package_description_data-content') }}" data-trigger="hover"  data-original-title="{{ __('order_packages_package_description_data-original-title') }}"    class="form-control {{ $errors->has('package_description') ? 'is-invalid' : '' }}" name="package_description" placeholder="{{ __('order_packages_package_description') }}"   >{{ $order_package->package_description   }}</textarea>
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-text"></i>
                                                                    </div>


                                @if ($errors->has('package_description'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('package_description') }}
                                                </div>
                                              @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_package_weight') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("package_weight" , $order_package->package_weight)  }}" data-placement="left"  data-content="{{ __('order_packages_package_weight_data-content') }}" data-trigger="hover"  data-original-title="{{ __('order_packages_package_weight_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('package_weight') ? 'is-invalid' : '' }}" name="package_weight" placeholder="{{ __('order_packages_package_weight') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('package_weight'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('package_weight') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_package_length') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("package_length" , $order_package->package_length)  }}" data-placement="left"  data-content="{{ __('order_packages_package_length_data-content') }}" data-trigger="hover"  data-original-title="{{ __('order_packages_package_length_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('package_length') ? 'is-invalid' : '' }}" name="package_length" placeholder="{{ __('order_packages_package_length') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('package_length'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('package_length') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_package_width') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("package_width" , $order_package->package_width)  }}" data-placement="left"  data-content="{{ __('order_packages_package_width_data-content') }}" data-trigger="hover"  data-original-title="{{ __('order_packages_package_width_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('package_width') ? 'is-invalid' : '' }}" name="package_width" placeholder="{{ __('order_packages_package_width') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('package_width'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('package_width') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_package_height') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("package_height" , $order_package->package_height)  }}" data-placement="left"  data-content="{{ __('order_packages_package_height_data-content') }}" data-trigger="hover"  data-original-title="{{ __('order_packages_package_height_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('package_height') ? 'is-invalid' : '' }}" name="package_height" placeholder="{{ __('order_packages_package_height') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('package_height'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('package_height') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_package_weight_vol') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("package_weight_vol" , $order_package->package_weight_vol)  }}" data-placement="left"  data-content="{{ __('order_packages_package_weight_vol_data-content') }}" data-trigger="hover"  data-original-title="{{ __('order_packages_package_weight_vol_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('package_weight_vol') ? 'is-invalid' : '' }}" name="package_weight_vol" placeholder="{{ __('order_packages_package_weight_vol') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('package_weight_vol'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('package_weight_vol') }}
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
