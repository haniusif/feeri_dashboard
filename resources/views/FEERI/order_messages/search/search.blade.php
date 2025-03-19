 <div class="col-12">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">{{ __('Filters') }}</h4>
                <form action="{{ route('order_messages.index') }}" method="GET">
                    <div class="row">




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_messages-list-order_id">{{ __('order_messages_order_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="order_id"  class="form-control" id="order_messages-list-order_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($orders as $order)
                             <option   @selected(request()->order_id == $order->id)     value="{{ $order->id }}" >{{ $order->order_reference }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_messages-list-sender_id">{{ __('order_messages_sender_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="sender_id"  class="form-control" id="order_messages-list-sender_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($users as $user)
                             <option   @selected(request()->sender_id == $user->id)     value="{{ $user->id }}" >{{ $user->first_name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_messages-list-receiver_id">{{ __('order_messages_receiver_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="receiver_id"  class="form-control" id="order_messages-list-receiver_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($users as $user)
                             <option   @selected(request()->receiver_id == $user->id)     value="{{ $user->id }}" >{{ $user->first_name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_messages-list-message">{{ __('order_messages_message') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="message" value="{{ request()->message }}"  type="text" placeholder="{{ __('order_messages_message') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_messages-list-created_at">{{ __('order_messages_created_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="created_at" type="date" value="{{ request()->created_at }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_messages-list-updated_at">{{ __('order_messages_updated_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="updated_at" type="date" value="{{ request()->updated_at }}"  />

                                                </fieldset>
                                            </div>
 <div class=" mt-3">
                                                <button type="submit" class="btn btn-info" >{{ __('Find') }}</button>
                                                <a href="{{ route('order_messages.index') }}" class="btn btn-link" >{{ __('Reset') }}</a>
                                            </div>
            </div>
                                    </form>
                                </div>
                            </div>
                              </div>
