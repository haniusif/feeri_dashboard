@extends('layouts.layoutMaster')

@section('content')


 			<div class="page-header">
							<h1>
							       @lang('messages.vehicle_handovers_vehicle_handovers')
								<small>
									<i class="ace-icon fa fa-angle-double-left"></i>
								      @lang('messages.vehicle_handovers_update')
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">




    	<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">  <a href="/vehicle_handovers">     @lang('messages.vehicle_handovers_vehicle_handovers')  </a>  </h4>

													<span class="widget-toolbar">
																	<a href="#" data-action="settings" data-toggle="dropdown">
															<i class="ace-icon fa fa-bars"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
															<li>
<a href="/vehicle_handovers/create" title = "@lang('messages.vehicle_handovers_add_new')  "  ><i class="fa fa-plus fa-lg"></i>
@lang('messages.vehicle_handovers_add_new')
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/vehicle_handovers') }}">
                        {!! csrf_field() !!}




 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_handovers_driver_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('vehicle_handovers_driver_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('vehicle_handovers_driver_id_data-original-title') }}"  class="form-control  {{ $errors->has('driver_id') ? 'is-invalid' : '' }} "  name="driver_id" >

                            @foreach($drivers as $driver)
                             <option  @selected(old('driver_id' , $vehicle_handover->driver_id) == $driver->id)    value="{{ $driver->id }}" >{{ $driver->full_name }}</option>
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
                                                                <span>{{ __('vehicle_handovers_vehicle_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('vehicle_handovers_vehicle_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('vehicle_handovers_vehicle_id_data-original-title') }}"  class="form-control  {{ $errors->has('vehicle_id') ? 'is-invalid' : '' }} "  name="vehicle_id" >

                            @foreach($vehicles as $vehicle)
                             <option  @selected(old('vehicle_id' , $vehicle_handover->vehicle_id) == $vehicle->id)    value="{{ $vehicle->id }}" >{{ $vehicle->plate_number }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('vehicle_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('vehicle_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_handovers_meter_upon_handover') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("meter_upon_handover" , $vehicle_handover->meter_upon_handover)  }}" data-placement="left"  data-content="{{ __('vehicle_handovers_meter_upon_handover_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_handovers_meter_upon_handover_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('meter_upon_handover') ? 'is-invalid' : '' }}" name="meter_upon_handover" placeholder="{{ __('vehicle_handovers_meter_upon_handover') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('meter_upon_handover'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('meter_upon_handover') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_handovers_authorization_start_date') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("authorization_start_date" , $vehicle_handover->authorization_start_date)  }}" data-placement="left"  data-content="{{ __('vehicle_handovers_authorization_start_date_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_handovers_authorization_start_date_data-original-title') }}"
                                                                     type="date"   class="form-control {{ $errors->has('authorization_start_date') ? 'is-invalid' : '' }}" name="authorization_start_date" placeholder="{{ __('vehicle_handovers_authorization_start_date') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('authorization_start_date'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('authorization_start_date') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_handovers_authorization_end_date') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("authorization_end_date" , $vehicle_handover->authorization_end_date)  }}" data-placement="left"  data-content="{{ __('vehicle_handovers_authorization_end_date_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_handovers_authorization_end_date_data-original-title') }}"
                                                                     type="date"   class="form-control {{ $errors->has('authorization_end_date') ? 'is-invalid' : '' }}" name="authorization_end_date" placeholder="{{ __('vehicle_handovers_authorization_end_date') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('authorization_end_date'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('authorization_end_date') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_handovers_front_right_image') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("front_right_image" , $vehicle_handover->front_right_image)  }}" data-placement="left"  data-content="{{ __('vehicle_handovers_front_right_image_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_handovers_front_right_image_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('front_right_image') ? 'is-invalid' : '' }}" name="front_right_image" placeholder="{{ __('vehicle_handovers_front_right_image') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('front_right_image'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('front_right_image') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_handovers_back_left_image') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("back_left_image" , $vehicle_handover->back_left_image)  }}" data-placement="left"  data-content="{{ __('vehicle_handovers_back_left_image_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_handovers_back_left_image_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('back_left_image') ? 'is-invalid' : '' }}" name="back_left_image" placeholder="{{ __('vehicle_handovers_back_left_image') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('back_left_image'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('back_left_image') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary pull-left">
                                    <i class="fa fa-btn fa-save"></i>@lang('messages.vehicle_handovers_update') 
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
