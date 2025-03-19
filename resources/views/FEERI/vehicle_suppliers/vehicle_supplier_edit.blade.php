@extends('layouts.layoutMaster')

@section('content')


 			<div class="page-header">
							<h1>
							       @lang('messages.vehicle_suppliers_vehicle_suppliers')
								<small>
									<i class="ace-icon fa fa-angle-double-left"></i>
								      @lang('messages.vehicle_suppliers_update')
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">




    	<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">  <a href="/vehicle_suppliers">     @lang('messages.vehicle_suppliers_vehicle_suppliers')  </a>  </h4>

													<span class="widget-toolbar">
																	<a href="#" data-action="settings" data-toggle="dropdown">
															<i class="ace-icon fa fa-bars"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
															<li>
<a href="/vehicle_suppliers/create" title = "@lang('messages.vehicle_suppliers_add_new')  "  ><i class="fa fa-plus fa-lg"></i>
@lang('messages.vehicle_suppliers_add_new')
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/vehicle_suppliers') }}">
                        {!! csrf_field() !!}




           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_suppliers_supplier_name') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("supplier_name" , $vehicle_supplier->supplier_name)  }}" data-placement="left"  data-content="{{ __('vehicle_suppliers_supplier_name_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_suppliers_supplier_name_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('supplier_name') ? 'is-invalid' : '' }}" name="supplier_name" placeholder="{{ __('vehicle_suppliers_supplier_name') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('supplier_name'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('supplier_name') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_suppliers_id_type_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('vehicle_suppliers_id_type_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('vehicle_suppliers_id_type_id_data-original-title') }}"  class="form-control  {{ $errors->has('id_type_id') ? 'is-invalid' : '' }} "  name="id_type_id" >

                            @foreach($id_types as $id_type)
                             <option  @selected(old('id_type_id' , $vehicle_supplier->id_type_id) == $id_type->id)    value="{{ $id_type->id }}" >{{ $id_type->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('id_type_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('id_type_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('vehicle_suppliers_id_number') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("id_number" , $vehicle_supplier->id_number)  }}" data-placement="left"  data-content="{{ __('vehicle_suppliers_id_number_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_suppliers_id_number_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('id_number') ? 'is-invalid' : '' }}" name="id_number" placeholder="{{ __('vehicle_suppliers_id_number') }}">
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
                                                                <span>{{ __('vehicle_suppliers_id_image') }}</span>
                                                            </div>
                                                            <div class="col-md-8">

                                                               <div class="row" >
                                                                <img src="{{ asset($vehicle_supplier->id_image) }}" alt="id_image" style="height:200px; width:100%" class="img-fluid rounded-sm mb-2" />

                                                                </div>

                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{  old('id_image')   }}" data-placement="left"  data-content="{{ __('vehicle_suppliers_id_image_data-content') }}" data-trigger="hover"  data-original-title="{{ __('vehicle_suppliers_id_image_data-original-title') }}"
                                                                     type="file"   class="form-control {{ $errors->has('id_image') ? 'is-invalid' : '' }}" name="id_image" placeholder="{{ __('vehicle_suppliers_id_image') }}"  >
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-image"></i>
                                                                    </div>

                                                                    @if ($errors->has('id_image'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('id_image') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary pull-left">
                                    <i class="fa fa-btn fa-save"></i>@lang('messages.vehicle_suppliers_update') 
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
