@extends('layouts.layoutMaster')

@section('content')


 			<div class="page-header">
							<h1>
							       @lang('messages.order_messages_order_messages')
								<small>
									<i class="ace-icon fa fa-angle-double-left"></i>
								      @lang('messages.order_messages_update')
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">




    	<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">  <a href="/order_messages">     @lang('messages.order_messages_order_messages')  </a>  </h4>

													<span class="widget-toolbar">
																	<a href="#" data-action="settings" data-toggle="dropdown">
															<i class="ace-icon fa fa-bars"></i>
														</a>

														<ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
															<li>
<a href="/order_messages/create" title = "@lang('messages.order_messages_add_new')  "  ><i class="fa fa-plus fa-lg"></i>
@lang('messages.order_messages_add_new')
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/order_messages') }}">
                        {!! csrf_field() !!}




 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_messages_order_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('order_messages_order_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('order_messages_order_id_data-original-title') }}"  class="form-control  {{ $errors->has('order_id') ? 'is-invalid' : '' }} "  name="order_id" >

                            @foreach($orders as $order)
                             <option  @selected(old('order_id' , $order_message->order_id) == $order->id)    value="{{ $order->id }}" >{{ $order->order_reference }}</option>
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
                                                                <span>{{ __('order_messages_sender_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('order_messages_sender_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('order_messages_sender_id_data-original-title') }}"  class="form-control  {{ $errors->has('sender_id') ? 'is-invalid' : '' }} "  name="sender_id" >

                            @foreach($users as $user)
                             <option  @selected(old('sender_id' , $order_message->sender_id) == $user->id)    value="{{ $user->id }}" >{{ $user->first_name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('sender_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('sender_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_messages_receiver_id') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">

                                                                     <select data-toggle="popover"   data-placement="left"  data-content="{{ __('order_messages_receiver_id_data-content') }}" data-trigger="hover" data-original-title="{{ __('order_messages_receiver_id_data-original-title') }}"  class="form-control  {{ $errors->has('receiver_id') ? 'is-invalid' : '' }} "  name="receiver_id" >

                            @foreach($users as $user)
                             <option  @selected(old('receiver_id' , $order_message->receiver_id) == $user->id)    value="{{ $user->id }}" >{{ $user->first_name }}</option>
                             @endforeach
                            </select>

                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-minus"></i>
                                                                    </div>

                                                                    @if ($errors->has('receiver_id'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('receiver_id') }}
                                                </div>
                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>






       <div class="col-12 mb-3">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>{{ __('order_messages_message') }}</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="position-relative has-icon-left">
                                                                    <textarea  data-toggle="popover"   data-placement="left"  data-content="{{ __('order_messages_message_data-content') }}" data-trigger="hover"  data-original-title="{{ __('order_messages_message_data-original-title') }}"    class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" placeholder="{{ __('order_messages_message') }}"   >{{ $order_message->message   }}</textarea>
                                                                    <div class="form-control-position">
                                                                        <i class="feather icon-file-text"></i>
                                                                    </div>


                                @if ($errors->has('message'))
                                                                    <div class="invalid-feedback">
                                                                    {{ $errors->first('message') }}
                                                </div>
                                              @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



 <div class="form-group">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn btn-primary pull-left">
                                    <i class="fa fa-btn fa-save"></i>@lang('messages.order_messages_update') 
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
