@extends('layouts.layoutMaster')

@section('content')


 			<div class="page-header">
							<h1>
							       @lang('messages.driver_shipments_driver_shipments')
								<small>
									<i class="ace-icon fa fa-angle-double-left"></i>
								      @lang('messages.driver_shipments_update')
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">




    	<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">  <a href="/driver_shipments">     @lang('messages.driver_shipments_driver_shipments')  </a>  </h4>

													<span class="widget-toolbar">
																	<a href="#" data-action="settings" data-toggle="dropdown">
															<i class="ace-icon fa fa-bars"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
															<li>
<a href="/driver_shipments/create" title = "@lang('messages.driver_shipments_add_new')  "  ><i class="fa fa-plus fa-lg"></i>
@lang('messages.driver_shipments_add_new')
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/driver_shipments') }}">
                        {!! csrf_field() !!}




 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('driver_shipments_project_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('driver_shipments_project_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('driver_shipments_project_id_data-original-title') }}"  class="form-control  {{ $errors->has('project_id') ? 'is-invalid' : '' }} "  name="project_id" >

                            @foreach($projects as $project)
                             <option  @selected(old('project_id' , $driver_shipment->project_id) == $project->id)    value="{{ $project->id }}" >{{ $project->name }}</option>
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



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('driver_shipments_driver_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('driver_shipments_driver_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('driver_shipments_driver_id_data-original-title') }}"  class="form-control  {{ $errors->has('driver_id') ? 'is-invalid' : '' }} "  name="driver_id" >

                            @foreach($drivers as $driver)
                             <option  @selected(old('driver_id' , $driver_shipment->driver_id) == $driver->id)    value="{{ $driver->id }}" >{{ $driver->full_name }}</option>
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
                                                                    <input  data-toggle="popover" value="{{ old("total_orders" , $driver_shipment->total_orders)  }}" data-placement="left"  data-content="{{ __('driver_shipments_total_orders_data-content') }}" data-trigger="hover"  data-original-title="{{ __('driver_shipments_total_orders_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('total_orders') ? 'is-invalid' : '' }}" name="total_orders" placeholder="{{ __('driver_shipments_total_orders') }}">
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
                                                                    <input  data-toggle="popover" value="{{ old("delivered_orders" , $driver_shipment->delivered_orders)  }}" data-placement="left"  data-content="{{ __('driver_shipments_delivered_orders_data-content') }}" data-trigger="hover"  data-original-title="{{ __('driver_shipments_delivered_orders_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('delivered_orders') ? 'is-invalid' : '' }}" name="delivered_orders" placeholder="{{ __('driver_shipments_delivered_orders') }}">
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
                                                                    <input  data-toggle="popover" value="{{ old("not_delivered_orders" , $driver_shipment->not_delivered_orders)  }}" data-placement="left"  data-content="{{ __('driver_shipments_not_delivered_orders_data-content') }}" data-trigger="hover"  data-original-title="{{ __('driver_shipments_not_delivered_orders_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('not_delivered_orders') ? 'is-invalid' : '' }}" name="not_delivered_orders" placeholder="{{ __('driver_shipments_not_delivered_orders') }}">
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
                                                                    <textarea  data-toggle="popover"   data-placement="left"  data-content="{{ __('driver_shipments_return_reasons_data-content') }}" data-trigger="hover"  data-original-title="{{ __('driver_shipments_return_reasons_data-original-title') }}"    class="form-control {{ $errors->has('return_reasons') ? 'is-invalid' : '' }}" name="return_reasons" placeholder="{{ __('driver_shipments_return_reasons') }}"   >{{ $driver_shipment->return_reasons   }}</textarea>
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
                                                                    <input  data-toggle="popover" value="{{ old("orders_date" , $driver_shipment->orders_date)  }}" data-placement="left"  data-content="{{ __('driver_shipments_orders_date_data-content') }}" data-trigger="hover"  data-original-title="{{ __('driver_shipments_orders_date_data-original-title') }}"
                                                                     type="date"   class="form-control {{ $errors->has('orders_date') ? 'is-invalid' : '' }}" name="orders_date" placeholder="{{ __('driver_shipments_orders_date') }}">
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



 <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary pull-left">
                                    <i class="fa fa-btn fa-save"></i>@lang('messages.driver_shipments_update') 
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
