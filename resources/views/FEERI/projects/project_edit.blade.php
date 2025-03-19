@extends('layouts.layoutMaster')

@section('content')


 			<div class="page-header">
							<h1>
							       @lang('messages.projects_projects')
								<small>
									<i class="ace-icon fa fa-angle-double-left"></i>
								      @lang('messages.projects_update')
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">




    	<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">  <a href="/projects">     @lang('messages.projects_projects')  </a>  </h4>

													<span class="widget-toolbar">
																	<a href="#" data-action="settings" data-toggle="dropdown">
															<i class="ace-icon fa fa-bars"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
															<li>
<a href="/projects/create" title = "@lang('messages.projects_add_new')  "  ><i class="fa fa-plus fa-lg"></i>
@lang('messages.projects_add_new')
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/projects') }}">
                        {!! csrf_field() !!}




           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('projects_name') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("name" , $project->name)  }}" data-placement="left"  data-content="{{ __('projects_name_data-content') }}" data-trigger="hover"  data-original-title="{{ __('projects_name_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" placeholder="{{ __('projects_name') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('name'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('name') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('projects_en_name') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("en_name" , $project->en_name)  }}" data-placement="left"  data-content="{{ __('projects_en_name_data-content') }}" data-trigger="hover"  data-original-title="{{ __('projects_en_name_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('en_name') ? 'is-invalid' : '' }}" name="en_name" placeholder="{{ __('projects_en_name') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('en_name'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('en_name') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>





           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('projects_logo') }}</span>
                                                            </div>
                                                            <div class="col-md-8">

                                                               <div class="row" >
                                                                <img src="{{ asset($project->logo) }}" alt="logo" style="height:200px; width:100%" class="img-fluid rounded-sm mb-2" />

                                                                </div>

                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{  old('logo')   }}" data-placement="left"  data-content="{{ __('projects_logo_data-content') }}" data-trigger="hover"  data-original-title="{{ __('projects_logo_data-original-title') }}"
                                                                     type="file"   class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}" name="logo" placeholder="{{ __('projects_logo') }}"  >
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-image"></i>
                                                                    </div>

                                                                    @if ($errors->has('logo'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('logo') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('projects_contact_name') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("contact_name" , $project->contact_name)  }}" data-placement="left"  data-content="{{ __('projects_contact_name_data-content') }}" data-trigger="hover"  data-original-title="{{ __('projects_contact_name_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('contact_name') ? 'is-invalid' : '' }}" name="contact_name" placeholder="{{ __('projects_contact_name') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('contact_name'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('contact_name') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('projects_contact_email') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("contact_email" , $project->contact_email)  }}" data-placement="left"  data-content="{{ __('projects_contact_email_data-content') }}" data-trigger="hover"  data-original-title="{{ __('projects_contact_email_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('contact_email') ? 'is-invalid' : '' }}" name="contact_email" placeholder="{{ __('projects_contact_email') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('contact_email'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('contact_email') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('projects_contact_phone_number') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("contact_phone_number" , $project->contact_phone_number)  }}" data-placement="left"  data-content="{{ __('projects_contact_phone_number_data-content') }}" data-trigger="hover"  data-original-title="{{ __('projects_contact_phone_number_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('contact_phone_number') ? 'is-invalid' : '' }}" name="contact_phone_number" placeholder="{{ __('projects_contact_phone_number') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('contact_phone_number'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('contact_phone_number') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('projects_tax_number') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("tax_number" , $project->tax_number)  }}" data-placement="left"  data-content="{{ __('projects_tax_number_data-content') }}" data-trigger="hover"  data-original-title="{{ __('projects_tax_number_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('tax_number') ? 'is-invalid' : '' }}" name="tax_number" placeholder="{{ __('projects_tax_number') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('tax_number'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('tax_number') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('projects_cr_number') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("cr_number" , $project->cr_number)  }}" data-placement="left"  data-content="{{ __('projects_cr_number_data-content') }}" data-trigger="hover"  data-original-title="{{ __('projects_cr_number_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('cr_number') ? 'is-invalid' : '' }}" name="cr_number" placeholder="{{ __('projects_cr_number') }}">
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('cr_number'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('cr_number') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



           <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('projects_address') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <input  data-toggle="popover" value="{{ old("address" , $project->address)  }}" data-placement="left"  data-content="{{ __('projects_address_data-content') }}" data-trigger="hover"  data-original-title="{{ __('projects_address_data-original-title') }}"
                                                                     type="text"   class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" placeholder="{{ __('projects_address') }}">
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
                                                                <span>{{ __('projects_project_status_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('projects_project_status_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('projects_project_status_id_data-original-title') }}"  class="form-control  {{ $errors->has('project_status_id') ? 'is-invalid' : '' }} "  name="project_status_id" >

                            @foreach($project_statuses as $project_status)
                             <option  @selected(old('project_status_id' , $project->project_status_id) == $project_status->id)    value="{{ $project_status->id }}" >{{ $project_status->name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('project_status_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('project_status_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



<div class="col-12 mb-3">
  <div class="form-group row">
    <div class="col-md-4">
      <span>{{ __('projects_is_active') }}</span>
    </div>
    <div class="col-md-8">
      <label class="switch">
        <input name="is_active" value="1" @checked($project->is_active == 1) type="checkbox" id="is_active" class="switch-input">
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
                                    <i class="fa fa-btn fa-save"></i>@lang('messages.projects_update') 
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
