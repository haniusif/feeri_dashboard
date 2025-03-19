@extends('layouts.layoutMaster')
@section('title', __('Role_has_permissions | Add new role_has_permission') )
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
            <li class="breadcrumb-item"><a href="{{ route('role_has_permissions.index') }}">{{ __('Role_has_permissions') }}</a>
            </li>
            <li class="breadcrumb-item active"> {{ __('Add new role_has_permission') }}
            </li>
        </ol>
    </div>
    @include('_partials.alerts')
    <section>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('role_has_permissions.store') }}"
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
                                <h5 class="mb-0">{{ __('Role_has_permissions') }}</h5> <small
                                    class="text-muted float-end">.</small>
                            </div>
                  <div class="card-body">



           <div class="col-12  mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('role_has_permissions_permission_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select   data-toggle="popover"   data-placement="left"  data-content="{{ __('role_has_permissions_permission_id_data-content') }}" data-trigger="hover"  data-original-title="{{ __('role_has_permissions_permission_id_data-original-title') }}"  class="form-control {{ $errors->has('permission_id') ? 'is-invalid' : '' }}"     data-validation-required-message="{{ __('This field is required') }}" name="permission_id" >

                            @foreach($permissions as $permission)
                             <option  @selected(old('permission_id' ) == $permission->id)   value="{{ $permission->id }}" >{{ $permission->name }}</option>
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



           <div class="col-12  mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('role_has_permissions_role_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select   data-toggle="popover"   data-placement="left"  data-content="{{ __('role_has_permissions_role_id_data-content') }}" data-trigger="hover"  data-original-title="{{ __('role_has_permissions_role_id_data-original-title') }}"  class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}"     data-validation-required-message="{{ __('This field is required') }}" name="role_id" >

                            @foreach($roles as $role)
                             <option  @selected(old('role_id' ) == $role->id)   value="{{ $role->id }}" >{{ $role->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('role_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('role_id') }}
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
