@extends('layouts.layoutMaster')

@section('content')


 			<div class="page-header">
							<h1>
							       @lang('messages.role_has_permissions_role_has_permissions')
								<small>
									<i class="ace-icon fa fa-angle-double-left"></i>
								      @lang('messages.role_has_permissions_update')
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">




    	<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">  <a href="/role_has_permissions">     @lang('messages.role_has_permissions_role_has_permissions')  </a>  </h4>

													<span class="widget-toolbar">
																	<a href="#" data-action="settings" data-toggle="dropdown">
															<i class="ace-icon fa fa-bars"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
															<li>
<a href="/role_has_permissions/create" title = "@lang('messages.role_has_permissions_add_new')  "  ><i class="fa fa-plus fa-lg"></i>
@lang('messages.role_has_permissions_add_new')
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/role_has_permissions') }}">
                        {!! csrf_field() !!}




 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('role_has_permissions_permission_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('role_has_permissions_permission_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('role_has_permissions_permission_id_data-original-title') }}"  class="form-control  {{ $errors->has('permission_id') ? 'is-invalid' : '' }} "  name="permission_id" >

                            @foreach($permissions as $permission)
                             <option  @selected(old('permission_id' , $role_has_permission->permission_id) == $permission->id)    value="{{ $permission->id }}" >{{ $permission->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('permission_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('permission_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('role_has_permissions_role_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('role_has_permissions_role_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('role_has_permissions_role_id_data-original-title') }}"  class="form-control  {{ $errors->has('role_id') ? 'is-invalid' : '' }} "  name="role_id" >

                            @foreach($roles as $role)
                             <option  @selected(old('role_id' , $role_has_permission->role_id) == $role->id)    value="{{ $role->id }}" >{{ $role->name }}</option>
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



 <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary pull-left">
                                    <i class="fa fa-btn fa-save"></i>@lang('messages.role_has_permissions_update') 
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
