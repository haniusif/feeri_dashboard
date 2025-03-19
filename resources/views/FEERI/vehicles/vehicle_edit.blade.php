@extends('layouts.layoutMaster')

@section('content')


 			<div class="page-header">
							<h1>
							       @lang('messages.vehicles_vehicles')
								<small>
									<i class="ace-icon fa fa-angle-double-left"></i>
								      @lang('messages.vehicles_update')
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">




    	<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">  <a href="/vehicles">     @lang('messages.vehicles_vehicles')  </a>  </h4>

													<span class="widget-toolbar">
																	<a href="#" data-action="settings" data-toggle="dropdown">
															<i class="ace-icon fa fa-bars"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
															<li>
<a href="/vehicles/create" title = "@lang('messages.vehicles_add_new')  "  ><i class="fa fa-plus fa-lg"></i>
@lang('messages.vehicles_add_new')
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/vehicles') }}">
                        {!! csrf_field() !!}




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



 <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary pull-left">
                                    <i class="fa fa-btn fa-save"></i>@lang('messages.vehicles_update') 
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
