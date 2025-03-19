@extends('layouts.layoutMaster')

@section('content')


 			<div class="page-header">
							<h1>
							       @lang('messages.customer_addresses_customer_addresses')
								<small>
									<i class="ace-icon fa fa-angle-double-left"></i>
								      @lang('messages.customer_addresses_update')
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">




    	<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">  <a href="/customer_addresses">     @lang('messages.customer_addresses_customer_addresses')  </a>  </h4>

													<span class="widget-toolbar">
																	<a href="#" data-action="settings" data-toggle="dropdown">
															<i class="ace-icon fa fa-bars"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
															<li>
<a href="/customer_addresses/create" title = "@lang('messages.customer_addresses_add_new')  "  ><i class="fa fa-plus fa-lg"></i>
@lang('messages.customer_addresses_add_new')
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/customer_addresses') }}">
                        {!! csrf_field() !!}




 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('customer_addresses_user_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('customer_addresses_user_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('customer_addresses_user_id_data-original-title') }}"  class="form-control  {{ $errors->has('user_id') ? 'is-invalid' : '' }} "  name="user_id" >

                            @foreach($users as $user)
                             <option  @selected(old('user_id' , $customer_address->user_id) == $user->id)    value="{{ $user->id }}" >{{ $user->first_name }}</option>
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
                                                                <span>{{ __('customer_addresses_country_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('customer_addresses_country_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('customer_addresses_country_id_data-original-title') }}"  class="form-control  {{ $errors->has('country_id') ? 'is-invalid' : '' }} "  name="country_id" >

                            @foreach($countries as $country)
                             <option  @selected(old('country_id' , $customer_address->country_id) == $country->id)    value="{{ $country->id }}" >{{ $country->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('country_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('country_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('customer_addresses_city_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('customer_addresses_city_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('customer_addresses_city_id_data-original-title') }}"  class="form-control  {{ $errors->has('city_id') ? 'is-invalid' : '' }} "  name="city_id" >

                            @foreach($cities as $city)
                             <option  @selected(old('city_id' , $customer_address->city_id) == $city->id)    value="{{ $city->id }}" >{{ $city->country_id }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('city_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('city_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('customer_addresses_neighbourhood_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('customer_addresses_neighbourhood_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('customer_addresses_neighbourhood_id_data-original-title') }}"  class="form-control  {{ $errors->has('neighbourhood_id') ? 'is-invalid' : '' }} "  name="neighbourhood_id" >

                            @foreach($neighbourhoods as $neighbourhood)
                             <option  @selected(old('neighbourhood_id' , $customer_address->neighbourhood_id) == $neighbourhood->id)    value="{{ $neighbourhood->id }}" >{{ $neighbourhood->city_id }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('neighbourhood_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('neighbourhood_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('customer_addresses_location_lat') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("location_lat" , $customer_address->location_lat)  }}" data-placement="left"  data-content="{{ __('customer_addresses_location_lat_data-content') }}" data-trigger="hover"  data-original-title="{{ __('customer_addresses_location_lat_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('location_lat') ? 'is-invalid' : '' }}" name="location_lat" placeholder="{{ __('customer_addresses_location_lat') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('location_lat'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('location_lat') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('customer_addresses_location_lanf') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("location_lanf" , $customer_address->location_lanf)  }}" data-placement="left"  data-content="{{ __('customer_addresses_location_lanf_data-content') }}" data-trigger="hover"  data-original-title="{{ __('customer_addresses_location_lanf_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('location_lanf') ? 'is-invalid' : '' }}" name="location_lanf" placeholder="{{ __('customer_addresses_location_lanf') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('location_lanf'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('location_lanf') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('customer_addresses_zip_code') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("zip_code" , $customer_address->zip_code)  }}" data-placement="left"  data-content="{{ __('customer_addresses_zip_code_data-content') }}" data-trigger="hover"  data-original-title="{{ __('customer_addresses_zip_code_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('zip_code') ? 'is-invalid' : '' }}" name="zip_code" placeholder="{{ __('customer_addresses_zip_code') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('zip_code'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('zip_code') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>






       <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('customer_addresses_address') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <textarea  data-toggle="popover"   data-placement="left"  data-content="{{ __('customer_addresses_address_data-content') }}" data-trigger="hover"  data-original-title="{{ __('customer_addresses_address_data-original-title') }}"    class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" placeholder="{{ __('customer_addresses_address') }}"   >{{ $customer_address->address   }}</textarea>
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-text"></i>
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
      <span>{{ __('customer_addresses_is_default') }}</span>
    </div>
    <div class="col-md-8">
      <label class="switch">
        <input name="is_default" value="1" @checked($customer_address->is_default == 1) type="checkbox" id="is_default" class="switch-input">
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
                                    <i class="fa fa-btn fa-save"></i>@lang('messages.customer_addresses_update') 
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
