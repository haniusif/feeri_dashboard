@extends('layouts.layoutMaster')

@section('content')


 			<div class="page-header">
							<h1>
							       @lang('messages.model_has_roles_model_has_roles')
								<small>
									<i class="ace-icon fa fa-angle-double-left"></i>
								      @lang('messages.model_has_roles_update')
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">




    	<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">  <a href="/model_has_roles">     @lang('messages.model_has_roles_model_has_roles')  </a>  </h4>

													<span class="widget-toolbar">
																	<a href="#" data-action="settings" data-toggle="dropdown">
															<i class="ace-icon fa fa-bars"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
															<li>
<a href="/model_has_roles/create" title = "@lang('messages.model_has_roles_add_new')  "  ><i class="fa fa-plus fa-lg"></i>
@lang('messages.model_has_roles_add_new')
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/model_has_roles') }}">
                        {!! csrf_field() !!}




 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('model_has_roles_role_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('model_has_roles_role_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('model_has_roles_role_id_data-original-title') }}"  class="form-control  {{ $errors->has('role_id') ? 'is-invalid' : '' }} "  name="role_id" >

                            @foreach($roles as $role)
                             <option  @selected(old('role_id' , $model_has_role->role_id) == $role->id)    value="{{ $role->id }}" >{{ $role->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('role_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('role_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('model_has_roles_model_type') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("model_type" , $model_has_role->model_type)  }}" data-placement="left"  data-content="{{ __('model_has_roles_model_type_data-content') }}" data-trigger="hover"  data-original-title="{{ __('model_has_roles_model_type_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('model_type') ? 'is-invalid' : '' }}" name="model_type" placeholder="{{ __('model_has_roles_model_type') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('model_type'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('model_type') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('model_has_roles_model_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("model_id" , $model_has_role->model_id)  }}" data-placement="left"  data-content="{{ __('model_has_roles_model_id_data-content') }}" data-trigger="hover"  data-original-title="{{ __('model_has_roles_model_id_data-original-title') }}"
                                                                     type="number"   class="form-control {{ $errors->has('model_id') ? 'is-invalid' : '' }}" name="model_id" placeholder="{{ __('model_has_roles_model_id') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('model_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('model_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary pull-left">
                                    <i class="fa fa-btn fa-save"></i>@lang('messages.model_has_roles_update') 
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
