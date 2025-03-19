 <div class="col-12">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">{{ __('Filters') }}</h4>
                <form action="{{ route('order_activities.index') }}" method="GET">
                    <div class="row">




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_activities-list-order_id">{{ __('order_activities_order_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="order_id"  class="form-control" id="order_activities-list-order_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($orders as $order)
                             <option   @selected(request()->order_id == $order->id)     value="{{ $order->id }}" >{{ $order->order_reference }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_activities-list-current_status">{{ __('order_activities_current_status') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="current_status" value="{{ request()->current_status }}"  type="text" placeholder="{{ __('order_activities_current_status') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_activities-list-activity_type">{{ __('order_activities_activity_type') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="activity_type" value="{{ request()->activity_type }}"  type="text" placeholder="{{ __('order_activities_activity_type') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_activities-list-description">{{ __('order_activities_description') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="description" value="{{ request()->description }}"  type="text" placeholder="{{ __('order_activities_description') }}"  />

                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_activities-list-user_id">{{ __('order_activities_user_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="user_id"  class="form-control" id="order_activities-list-user_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($users as $user)
                             <option   @selected(request()->user_id == $user->id)     value="{{ $user->id }}" >{{ $user->first_name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_activities-list-created_at">{{ __('order_activities_created_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="created_at" type="date" value="{{ request()->created_at }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_activities-list-updated_at">{{ __('order_activities_updated_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="updated_at" type="date" value="{{ request()->updated_at }}"  />

                                                </fieldset>
                                            </div>
 <div class=" mt-3">
                                                <button type="submit" class="btn btn-info" >{{ __('Find') }}</button>
                                                <a href="{{ route('order_activities.index') }}" class="btn btn-link" >{{ __('Reset') }}</a>
                                            </div>
            </div>
                                    </form>
                                </div>
                            </div>
                              </div>
