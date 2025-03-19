@extends('layouts.layoutMaster')
@section('title', __('Model_has_permissions | Add new model_has_permission') )
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
            <li class="breadcrumb-item"><a href="{{ route('model_has_permissions.index') }}">{{ __('Model_has_permissions') }}</a>
            </li>
            <li class="breadcrumb-item active"> {{ $model_has_permission->id }}
            </li>
        </ol>
    </div>
    @include('_partials.alerts')
    <section>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('model_has_permissions.update' , $model_has_permission->id ) }}"
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
                                <h5 class="mb-0">{{ __('Model_has_permissions') }}</h5> <small
                                    class="text-muted float-end">.</small>
                            </div>
                  <div class="card-body">










 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('model_has_permissions_permission_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('model_has_permissions_permission_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('model_has_permissions_permission_id_data-original-title') }}"  class="form-control  {{ $errors->has('permission_id') ? 'is-invalid' : '' }} "  name="permission_id" >

                            @foreach($permissions as $permission)
                             <option  @selected(old('permission_id' , $model_has_permission->permission_id) == $permission->id)    value="{{ $permission->id }}" >{{ $permission->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('permission_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('permission_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('model_has_permissions_model_type') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("model_type" , $model_has_permission->model_type)  }}" data-placement="left"  data-content="{{ __('model_has_permissions_model_type_data-content') }}" data-trigger="hover"  data-original-title="{{ __('model_has_permissions_model_type_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('model_type') ? 'is-invalid' : '' }}" name="model_type" placeholder="{{ __('model_has_permissions_model_type') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('model_type'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('model_type') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('model_has_permissions_model_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("model_id" , $model_has_permission->model_id)  }}" data-placement="left"  data-content="{{ __('model_has_permissions_model_id_data-content') }}" data-trigger="hover"  data-original-title="{{ __('model_has_permissions_model_id_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('model_id') ? 'is-invalid' : '' }}" name="model_id" placeholder="{{ __('model_has_permissions_model_id') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('model_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('model_id') }}
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
