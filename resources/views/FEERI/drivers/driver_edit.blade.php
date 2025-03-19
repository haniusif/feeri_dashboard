@extends('layouts.layoutMaster')

@section('content')


 			<div class="page-header">
							<h1>
							       @lang('messages.drivers_drivers')
								<small>
									<i class="ace-icon fa fa-angle-double-left"></i>
								      @lang('messages.drivers_update')
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">




    	<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">  <a href="/drivers">     @lang('messages.drivers_drivers')  </a>  </h4>

													<span class="widget-toolbar">
																	<a href="#" data-action="settings" data-toggle="dropdown">
															<i class="ace-icon fa fa-bars"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
															<li>
<a href="/drivers/create" title = "@lang('messages.drivers_add_new')  "  ><i class="fa fa-plus fa-lg"></i>
@lang('messages.drivers_add_new')
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/drivers') }}">
                        {!! csrf_field() !!}




           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('drivers_full_name') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("full_name" , $driver->full_name)  }}" data-placement="left"  data-content="{{ __('drivers_full_name_data-content') }}" data-trigger="hover"  data-original-title="{{ __('drivers_full_name_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" name="full_name" placeholder="{{ __('drivers_full_name') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('full_name'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('full_name') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('drivers_en_full_name') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("en_full_name" , $driver->en_full_name)  }}" data-placement="left"  data-content="{{ __('drivers_en_full_name_data-content') }}" data-trigger="hover"  data-original-title="{{ __('drivers_en_full_name_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('en_full_name') ? 'is-invalid' : '' }}" name="en_full_name" placeholder="{{ __('drivers_en_full_name') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('en_full_name'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('en_full_name') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('drivers_phone_number') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("phone_number" , $driver->phone_number)  }}" data-placement="left"  data-content="{{ __('drivers_phone_number_data-content') }}" data-trigger="hover"  data-original-title="{{ __('drivers_phone_number_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" name="phone_number" placeholder="{{ __('drivers_phone_number') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('phone_number'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('phone_number') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('drivers_id_number') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("id_number" , $driver->id_number)  }}" data-placement="left"  data-content="{{ __('drivers_id_number_data-content') }}" data-trigger="hover"  data-original-title="{{ __('drivers_id_number_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" name="id_number" placeholder="{{ __('drivers_id_number') }}">
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
                                                                <span>{{ __('drivers_id_expiry_at') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("id_expiry_at" , $driver->id_expiry_at)  }}" data-placement="left"  data-content="{{ __('drivers_id_expiry_at_data-content') }}" data-trigger="hover"  data-original-title="{{ __('drivers_id_expiry_at_data-original-title') }}"
                                                                     type="date"   class="form-control {{ $errors->has('id_expiry_at') ? 'is-invalid' : '' }}" name="id_expiry_at" placeholder="{{ __('drivers_id_expiry_at') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('id_expiry_at'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('id_expiry_at') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('drivers_dob') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("dob" , $driver->dob)  }}" data-placement="left"  data-content="{{ __('drivers_dob_data-content') }}" data-trigger="hover"  data-original-title="{{ __('drivers_dob_data-original-title') }}"
                                                                     type="date"   class="form-control {{ $errors->has('dob') ? 'is-invalid' : '' }}" name="dob" placeholder="{{ __('drivers_dob') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('dob'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('dob') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>





           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('drivers_image') }}</span>
                                                            </div>
                                                            <div class="col-md-8">

                                                               <div class="row" >
                                                                <img src="{{ asset($driver->image) }}" alt="image" style="height:200px; width:100%" class="img-fluid rounded-sm mb-2" />

                                                                </div>

                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{  old('image')   }}" data-placement="left"  data-content="{{ __('drivers_image_data-content') }}" data-trigger="hover"  data-original-title="{{ __('drivers_image_data-original-title') }}"
                                                                     type="file"   class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" name="image" placeholder="{{ __('drivers_image') }}"  >
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-image"></i>
                                                                    </div>

                                                                    @if ($errors->has('image'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('image') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('drivers_license_number') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("license_number" , $driver->license_number)  }}" data-placement="left"  data-content="{{ __('drivers_license_number_data-content') }}" data-trigger="hover"  data-original-title="{{ __('drivers_license_number_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('license_number') ? 'is-invalid' : '' }}" name="license_number" placeholder="{{ __('drivers_license_number') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('license_number'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('license_number') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('drivers_license_expiry_at') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("license_expiry_at" , $driver->license_expiry_at)  }}" data-placement="left"  data-content="{{ __('drivers_license_expiry_at_data-content') }}" data-trigger="hover"  data-original-title="{{ __('drivers_license_expiry_at_data-original-title') }}"
                                                                     type="date"   class="form-control {{ $errors->has('license_expiry_at') ? 'is-invalid' : '' }}" name="license_expiry_at" placeholder="{{ __('drivers_license_expiry_at') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('license_expiry_at'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('license_expiry_at') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('drivers_nationality_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('drivers_nationality_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('drivers_nationality_id_data-original-title') }}"  class="form-control  {{ $errors->has('nationality_id') ? 'is-invalid' : '' }} "  name="nationality_id" >

                            @foreach($nationalities as $nationality)
                             <option  @selected(old('nationality_id' , $driver->nationality_id) == $nationality->id)    value="{{ $nationality->id }}" >{{ $nationality->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('nationality_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('nationality_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('drivers_driver_contract_type_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('drivers_driver_contract_type_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('drivers_driver_contract_type_id_data-original-title') }}"  class="form-control  {{ $errors->has('driver_contract_type_id') ? 'is-invalid' : '' }} "  name="driver_contract_type_id" >

                            @foreach($driver_contract_types as $driver_contract_type)
                             <option  @selected(old('driver_contract_type_id' , $driver->driver_contract_type_id) == $driver_contract_type->id)    value="{{ $driver_contract_type->id }}" >{{ $driver_contract_type->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('driver_contract_type_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('driver_contract_type_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('drivers_current_vehicle_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("current_vehicle_id" , $driver->current_vehicle_id)  }}" data-placement="left"  data-content="{{ __('drivers_current_vehicle_id_data-content') }}" data-trigger="hover"  data-original-title="{{ __('drivers_current_vehicle_id_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('current_vehicle_id') ? 'is-invalid' : '' }}" name="current_vehicle_id" placeholder="{{ __('drivers_current_vehicle_id') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('current_vehicle_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('current_vehicle_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('drivers_current_project_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("current_project_id" , $driver->current_project_id)  }}" data-placement="left"  data-content="{{ __('drivers_current_project_id_data-content') }}" data-trigger="hover"  data-original-title="{{ __('drivers_current_project_id_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('current_project_id') ? 'is-invalid' : '' }}" name="current_project_id" placeholder="{{ __('drivers_current_project_id') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('current_project_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('current_project_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('drivers_address') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("address" , $driver->address)  }}" data-placement="left"  data-content="{{ __('drivers_address_data-content') }}" data-trigger="hover"  data-original-title="{{ __('drivers_address_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" placeholder="{{ __('drivers_address') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
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
      <span>{{ __('drivers_is_active') }}</span>
    </div>
    <div class="col-md-8">
      <label class="switch">
        <input name="is_active" value="1" @checked($driver->is_active == 1) type="checkbox" id="is_active" class="switch-input">
        <span class="switch-toggle-slider">
          <span class="switch-on"></span>
          <span class="switch-off"></span>
        </span>
        <span class="switch-label"></span>
      </label>
      @if ($errors->has('is_active'))
      <div class="invalid-feedback">
        {{ $errors->first('is_active') }}
      </div>
      @endif
    </div>
  </div>
</div>



 <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary pull-left">
                                    <i class="fa fa-btn fa-save"></i>@lang('messages.drivers_update') 
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
