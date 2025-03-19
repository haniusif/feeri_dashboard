@extends('layouts.layoutMaster')

@section('content')


 			<div class="page-header">
							<h1>
							       @lang('messages.orders_orders')
								<small>
									<i class="ace-icon fa fa-angle-double-left"></i>
								      @lang('messages.orders_update')
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">




    	<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">  <a href="/orders">     @lang('messages.orders_orders')  </a>  </h4>

													<span class="widget-toolbar">
																	<a href="#" data-action="settings" data-toggle="dropdown">
															<i class="ace-icon fa fa-bars"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
															<li>
<a href="/orders/create" title = "@lang('messages.orders_add_new')  "  ><i class="fa fa-plus fa-lg"></i>
@lang('messages.orders_add_new')
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/orders') }}">
                        {!! csrf_field() !!}




           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_order_reference') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("order_reference" , $order->order_reference)  }}" data-placement="left"  data-content="{{ __('orders_order_reference_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_order_reference_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('order_reference') ? 'is-invalid' : '' }}" name="order_reference" placeholder="{{ __('orders_order_reference') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('order_reference'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('order_reference') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_order_status_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('orders_order_status_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('orders_order_status_id_data-original-title') }}"  class="form-control  {{ $errors->has('order_status_id') ? 'is-invalid' : '' }} "  name="order_status_id" >

                            @foreach($order_statuses as $order_status)
                             <option  @selected(old('order_status_id' , $order->order_status_id) == $order_status->id)    value="{{ $order_status->id }}" >{{ $order_status->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('order_status_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('order_status_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_user_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('orders_user_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('orders_user_id_data-original-title') }}"  class="form-control  {{ $errors->has('user_id') ? 'is-invalid' : '' }} "  name="user_id" >

                            @foreach($users as $user)
                             <option  @selected(old('user_id' , $order->user_id) == $user->id)    value="{{ $user->id }}" >{{ $user->first_name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('user_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('user_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_cod_amount') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("cod_amount" , $order->cod_amount)  }}" data-placement="left"  data-content="{{ __('orders_cod_amount_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_cod_amount_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('cod_amount') ? 'is-invalid' : '' }}" name="cod_amount" placeholder="{{ __('orders_cod_amount') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('cod_amount'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('cod_amount') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_pickup_reference') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("pickup_reference" , $order->pickup_reference)  }}" data-placement="left"  data-content="{{ __('orders_pickup_reference_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_pickup_reference_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('pickup_reference') ? 'is-invalid' : '' }}" name="pickup_reference" placeholder="{{ __('orders_pickup_reference') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('pickup_reference'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('pickup_reference') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_pickup_name') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("pickup_name" , $order->pickup_name)  }}" data-placement="left"  data-content="{{ __('orders_pickup_name_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_pickup_name_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('pickup_name') ? 'is-invalid' : '' }}" name="pickup_name" placeholder="{{ __('orders_pickup_name') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('pickup_name'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('pickup_name') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_pickup_phone_number') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("pickup_phone_number" , $order->pickup_phone_number)  }}" data-placement="left"  data-content="{{ __('orders_pickup_phone_number_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_pickup_phone_number_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('pickup_phone_number') ? 'is-invalid' : '' }}" name="pickup_phone_number" placeholder="{{ __('orders_pickup_phone_number') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('pickup_phone_number'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('pickup_phone_number') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_pickup_country_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('orders_pickup_country_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('orders_pickup_country_id_data-original-title') }}"  class="form-control  {{ $errors->has('pickup_country_id') ? 'is-invalid' : '' }} "  name="pickup_country_id" >

                            @foreach($countries as $country)
                             <option  @selected(old('pickup_country_id' , $order->pickup_country_id) == $country->id)    value="{{ $country->id }}" >{{ $country->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('pickup_country_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('pickup_country_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_pickup_city_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('orders_pickup_city_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('orders_pickup_city_id_data-original-title') }}"  class="form-control  {{ $errors->has('pickup_city_id') ? 'is-invalid' : '' }} "  name="pickup_city_id" >

                            @foreach($cities as $city)
                             <option  @selected(old('pickup_city_id' , $order->pickup_city_id) == $city->id)    value="{{ $city->id }}" >{{ $city->country_id }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('pickup_city_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('pickup_city_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_pickup_neighbourhood_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('orders_pickup_neighbourhood_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('orders_pickup_neighbourhood_id_data-original-title') }}"  class="form-control  {{ $errors->has('pickup_neighbourhood_id') ? 'is-invalid' : '' }} "  name="pickup_neighbourhood_id" >

                            @foreach($neighbourhoods as $neighbourhood)
                             <option  @selected(old('pickup_neighbourhood_id' , $order->pickup_neighbourhood_id) == $neighbourhood->id)    value="{{ $neighbourhood->id }}" >{{ $neighbourhood->city_id }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('pickup_neighbourhood_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('pickup_neighbourhood_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_pickup_address') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("pickup_address" , $order->pickup_address)  }}" data-placement="left"  data-content="{{ __('orders_pickup_address_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_pickup_address_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('pickup_address') ? 'is-invalid' : '' }}" name="pickup_address" placeholder="{{ __('orders_pickup_address') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('pickup_address'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('pickup_address') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_pickup_latitude') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("pickup_latitude" , $order->pickup_latitude)  }}" data-placement="left"  data-content="{{ __('orders_pickup_latitude_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_pickup_latitude_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('pickup_latitude') ? 'is-invalid' : '' }}" name="pickup_latitude" placeholder="{{ __('orders_pickup_latitude') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('pickup_latitude'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('pickup_latitude') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_pickup_longitude') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("pickup_longitude" , $order->pickup_longitude)  }}" data-placement="left"  data-content="{{ __('orders_pickup_longitude_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_pickup_longitude_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('pickup_longitude') ? 'is-invalid' : '' }}" name="pickup_longitude" placeholder="{{ __('orders_pickup_longitude') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('pickup_longitude'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('pickup_longitude') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_pickup_time') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("pickup_time" , $order->pickup_time)  }}" data-placement="left"  data-content="{{ __('orders_pickup_time_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_pickup_time_data-original-title') }}"
                                                                     type="date"   class="form-control {{ $errors->has('pickup_time') ? 'is-invalid' : '' }}" name="pickup_time" placeholder="{{ __('orders_pickup_time') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('pickup_time'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('pickup_time') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_dropoff_reference') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("dropoff_reference" , $order->dropoff_reference)  }}" data-placement="left"  data-content="{{ __('orders_dropoff_reference_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_dropoff_reference_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('dropoff_reference') ? 'is-invalid' : '' }}" name="dropoff_reference" placeholder="{{ __('orders_dropoff_reference') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('dropoff_reference'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('dropoff_reference') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_dropoff_name') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("dropoff_name" , $order->dropoff_name)  }}" data-placement="left"  data-content="{{ __('orders_dropoff_name_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_dropoff_name_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('dropoff_name') ? 'is-invalid' : '' }}" name="dropoff_name" placeholder="{{ __('orders_dropoff_name') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('dropoff_name'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('dropoff_name') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_dropoff_phone_number') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("dropoff_phone_number" , $order->dropoff_phone_number)  }}" data-placement="left"  data-content="{{ __('orders_dropoff_phone_number_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_dropoff_phone_number_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('dropoff_phone_number') ? 'is-invalid' : '' }}" name="dropoff_phone_number" placeholder="{{ __('orders_dropoff_phone_number') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('dropoff_phone_number'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('dropoff_phone_number') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_dropoff_country_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('orders_dropoff_country_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('orders_dropoff_country_id_data-original-title') }}"  class="form-control  {{ $errors->has('dropoff_country_id') ? 'is-invalid' : '' }} "  name="dropoff_country_id" >

                            @foreach($countries as $country)
                             <option  @selected(old('dropoff_country_id' , $order->dropoff_country_id) == $country->id)    value="{{ $country->id }}" >{{ $country->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('dropoff_country_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('dropoff_country_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_dropoff_city_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('orders_dropoff_city_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('orders_dropoff_city_id_data-original-title') }}"  class="form-control  {{ $errors->has('dropoff_city_id') ? 'is-invalid' : '' }} "  name="dropoff_city_id" >

                            @foreach($cities as $city)
                             <option  @selected(old('dropoff_city_id' , $order->dropoff_city_id) == $city->id)    value="{{ $city->id }}" >{{ $city->country_id }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('dropoff_city_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('dropoff_city_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_dropoff_neighbourhood_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('orders_dropoff_neighbourhood_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('orders_dropoff_neighbourhood_id_data-original-title') }}"  class="form-control  {{ $errors->has('dropoff_neighbourhood_id') ? 'is-invalid' : '' }} "  name="dropoff_neighbourhood_id" >

                            @foreach($neighbourhoods as $neighbourhood)
                             <option  @selected(old('dropoff_neighbourhood_id' , $order->dropoff_neighbourhood_id) == $neighbourhood->id)    value="{{ $neighbourhood->id }}" >{{ $neighbourhood->city_id }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('dropoff_neighbourhood_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('dropoff_neighbourhood_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_dropoff_address') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("dropoff_address" , $order->dropoff_address)  }}" data-placement="left"  data-content="{{ __('orders_dropoff_address_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_dropoff_address_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('dropoff_address') ? 'is-invalid' : '' }}" name="dropoff_address" placeholder="{{ __('orders_dropoff_address') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('dropoff_address'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('dropoff_address') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_dropoff_latitude') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("dropoff_latitude" , $order->dropoff_latitude)  }}" data-placement="left"  data-content="{{ __('orders_dropoff_latitude_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_dropoff_latitude_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('dropoff_latitude') ? 'is-invalid' : '' }}" name="dropoff_latitude" placeholder="{{ __('orders_dropoff_latitude') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('dropoff_latitude'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('dropoff_latitude') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_dropoff_longitude') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("dropoff_longitude" , $order->dropoff_longitude)  }}" data-placement="left"  data-content="{{ __('orders_dropoff_longitude_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_dropoff_longitude_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('dropoff_longitude') ? 'is-invalid' : '' }}" name="dropoff_longitude" placeholder="{{ __('orders_dropoff_longitude') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('dropoff_longitude'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('dropoff_longitude') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('orders_dropoff_time') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("dropoff_time" , $order->dropoff_time)  }}" data-placement="left"  data-content="{{ __('orders_dropoff_time_data-content') }}" data-trigger="hover"  data-original-title="{{ __('orders_dropoff_time_data-original-title') }}"
                                                                     type="date"   class="form-control {{ $errors->has('dropoff_time') ? 'is-invalid' : '' }}" name="dropoff_time" placeholder="{{ __('orders_dropoff_time') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('dropoff_time'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('dropoff_time') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary pull-left">
                                    <i class="fa fa-btn fa-save"></i>@lang('messages.orders_update') 
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
