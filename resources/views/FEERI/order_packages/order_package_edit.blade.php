@extends('layouts.layoutMaster')

@section('content')


 			<div class="page-header">
							<h1>
							       @lang('messages.order_packages_order_packages')
								<small>
									<i class="ace-icon fa fa-angle-double-left"></i>
								      @lang('messages.order_packages_update')
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">




    	<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">  <a href="/order_packages">     @lang('messages.order_packages_order_packages')  </a>  </h4>

													<span class="widget-toolbar">
																	<a href="#" data-action="settings" data-toggle="dropdown">
															<i class="ace-icon fa fa-bars"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
															<li>
<a href="/order_packages/create" title = "@lang('messages.order_packages_add_new')  "  ><i class="fa fa-plus fa-lg"></i>
@lang('messages.order_packages_add_new')
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/order_packages') }}">
                        {!! csrf_field() !!}




 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_order_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('order_packages_order_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('order_packages_order_id_data-original-title') }}"  class="form-control  {{ $errors->has('order_id') ? 'is-invalid' : '' }} "  name="order_id" >

                            @foreach($orders as $order)
                             <option  @selected(old('order_id' , $order_package->order_id) == $order->id)    value="{{ $order->id }}" >{{ $order->order_reference }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('order_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('order_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_package_name') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("package_name" , $order_package->package_name)  }}" data-placement="left"  data-content="{{ __('order_packages_package_name_data-content') }}" data-trigger="hover"  data-original-title="{{ __('order_packages_package_name_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('package_name') ? 'is-invalid' : '' }}" name="package_name" placeholder="{{ __('order_packages_package_name') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('package_name'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('package_name') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>






       <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_package_description') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <textarea  data-toggle="popover"   data-placement="left"  data-content="{{ __('order_packages_package_description_data-content') }}" data-trigger="hover"  data-original-title="{{ __('order_packages_package_description_data-original-title') }}"    class="form-control {{ $errors->has('package_description') ? 'is-invalid' : '' }}" name="package_description" placeholder="{{ __('order_packages_package_description') }}"   >{{ $order_package->package_description   }}</textarea>
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-text"></i>
                                                                    </div>


                                @if ($errors->has('package_description'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('package_description') }}
                                                </div>
                                              @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_package_weight') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("package_weight" , $order_package->package_weight)  }}" data-placement="left"  data-content="{{ __('order_packages_package_weight_data-content') }}" data-trigger="hover"  data-original-title="{{ __('order_packages_package_weight_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('package_weight') ? 'is-invalid' : '' }}" name="package_weight" placeholder="{{ __('order_packages_package_weight') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('package_weight'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('package_weight') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_package_length') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("package_length" , $order_package->package_length)  }}" data-placement="left"  data-content="{{ __('order_packages_package_length_data-content') }}" data-trigger="hover"  data-original-title="{{ __('order_packages_package_length_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('package_length') ? 'is-invalid' : '' }}" name="package_length" placeholder="{{ __('order_packages_package_length') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('package_length'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('package_length') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_package_width') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("package_width" , $order_package->package_width)  }}" data-placement="left"  data-content="{{ __('order_packages_package_width_data-content') }}" data-trigger="hover"  data-original-title="{{ __('order_packages_package_width_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('package_width') ? 'is-invalid' : '' }}" name="package_width" placeholder="{{ __('order_packages_package_width') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('package_width'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('package_width') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_package_height') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("package_height" , $order_package->package_height)  }}" data-placement="left"  data-content="{{ __('order_packages_package_height_data-content') }}" data-trigger="hover"  data-original-title="{{ __('order_packages_package_height_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('package_height') ? 'is-invalid' : '' }}" name="package_height" placeholder="{{ __('order_packages_package_height') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('package_height'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('package_height') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_packages_package_weight_vol') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("package_weight_vol" , $order_package->package_weight_vol)  }}" data-placement="left"  data-content="{{ __('order_packages_package_weight_vol_data-content') }}" data-trigger="hover"  data-original-title="{{ __('order_packages_package_weight_vol_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('package_weight_vol') ? 'is-invalid' : '' }}" name="package_weight_vol" placeholder="{{ __('order_packages_package_weight_vol') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('package_weight_vol'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('package_weight_vol') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary pull-left">
                                    <i class="fa fa-btn fa-save"></i>@lang('messages.order_packages_update') 
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
