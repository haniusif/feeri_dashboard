@extends('layouts.layoutMaster')

@section('content')


 			<div class="page-header">
							<h1>
							       @lang('messages.driver_bank_accounts_driver_bank_accounts')
								<small>
									<i class="ace-icon fa fa-angle-double-left"></i>
								      @lang('messages.driver_bank_accounts_update')
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">




    	<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">  <a href="/driver_bank_accounts">     @lang('messages.driver_bank_accounts_driver_bank_accounts')  </a>  </h4>

													<span class="widget-toolbar">
																	<a href="#" data-action="settings" data-toggle="dropdown">
															<i class="ace-icon fa fa-bars"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
															<li>
<a href="/driver_bank_accounts/create" title = "@lang('messages.driver_bank_accounts_add_new')  "  ><i class="fa fa-plus fa-lg"></i>
@lang('messages.driver_bank_accounts_add_new')
</a>
															</li>



														</ul>

														<a href="#" data-action="reload">
															<i class="ace-icon fa fa-refresh"></i>
														</a>

                                                        		<a href="#" data-action="fullscreen" class="orange2">
														<i class="ace-icon fa fa-expand"></i>
													</a>

														<a href="#" data-action="collapse">
															<i class="ace-icon fa fa-chevron-up"></i>
														</a>

														<a href="#" data-action="close">
															<i class="ace-icon fa fa-times"></i>
														</a>
													</span>
												</div>

												<div class="widget-body">
													<div class="widget-main">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/driver_bank_accounts') }}">
                        {!! csrf_field() !!}




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



 <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary pull-left">
                                    <i class="fa fa-btn fa-save"></i>@lang('messages.driver_bank_accounts_update') 
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
          
               </div>
                </div>
                </div>







@endsection
