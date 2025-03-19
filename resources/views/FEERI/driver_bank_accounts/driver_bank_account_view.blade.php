@extends('layouts.layoutMaster')
@section('title', __('Driver_bank_accounts | Add new driver_bank_account') )
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
            <li class="breadcrumb-item"><a href="{{ route('driver_bank_accounts.index') }}">{{ __('Driver_bank_accounts') }}</a>
            </li>
            <li class="breadcrumb-item active"> {{ $driver_bank_account->id }}
            </li>
        </ol>
    </div>
    @include('_partials.alerts')
    <section>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('driver_bank_accounts.update' , $driver_bank_account->id ) }}"
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
                                <h5 class="mb-0">{{ __('Driver_bank_accounts') }}</h5> <small
                                    class="text-muted float-end">.</small>
                            </div>
                  <div class="card-body">










 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('driver_bank_accounts_driver_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('driver_bank_accounts_driver_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('driver_bank_accounts_driver_id_data-original-title') }}"  class="form-control  {{ $errors->has('driver_id') ? 'is-invalid' : '' }} "  name="driver_id" >

                            @foreach($drivers as $driver)
                             <option  @selected(old('driver_id' , $driver_bank_account->driver_id) == $driver->id)    value="{{ $driver->id }}" >{{ $driver->full_name }}</option>
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
                                                                <span>{{ __('driver_bank_accounts_bank_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('driver_bank_accounts_bank_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('driver_bank_accounts_bank_id_data-original-title') }}"  class="form-control  {{ $errors->has('bank_id') ? 'is-invalid' : '' }} "  name="bank_id" >

                            @foreach($banks as $bank)
                             <option  @selected(old('bank_id' , $driver_bank_account->bank_id) == $bank->id)    value="{{ $bank->id }}" >{{ $bank->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('bank_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('bank_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('driver_bank_accounts_account_number') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("account_number" , $driver_bank_account->account_number)  }}" data-placement="left"  data-content="{{ __('driver_bank_accounts_account_number_data-content') }}" data-trigger="hover"  data-original-title="{{ __('driver_bank_accounts_account_number_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('account_number') ? 'is-invalid' : '' }}" name="account_number" placeholder="{{ __('driver_bank_accounts_account_number') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('account_number'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('account_number') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('driver_bank_accounts_ipan') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("ipan" , $driver_bank_account->ipan)  }}" data-placement="left"  data-content="{{ __('driver_bank_accounts_ipan_data-content') }}" data-trigger="hover"  data-original-title="{{ __('driver_bank_accounts_ipan_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('ipan') ? 'is-invalid' : '' }}" name="ipan" placeholder="{{ __('driver_bank_accounts_ipan') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('ipan'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('ipan') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



<div class="col-12 mb-3">
  <div class="form-group row">
    <div class="col-md-4">
      <span>{{ __('driver_bank_accounts_is_default') }}</span>
    </div>
    <div class="col-md-8">
      <label class="switch">
        <input name="is_default" value="1" @checked($driver_bank_account->is_default == 1) type="checkbox" id="is_default" class="switch-input">
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
