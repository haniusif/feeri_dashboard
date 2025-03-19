 <div class="col-12">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">{{ __('Filters') }}</h4>
                <form action="{{ route('driver_shipments.index') }}" method="GET">
                    <div class="row">




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_shipments-list-project_id">{{ __('driver_shipments_project_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="project_id"  class="form-control" id="driver_shipments-list-project_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($projects as $project)
                             <option   @selected(request()->project_id == $project->id)     value="{{ $project->id }}" >{{ $project->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_shipments-list-driver_id">{{ __('driver_shipments_driver_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="driver_id"  class="form-control" id="driver_shipments-list-driver_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($drivers as $driver)
                             <option   @selected(request()->driver_id == $driver->id)     value="{{ $driver->id }}" >{{ $driver->full_name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_shipments-list-total_orders">{{ __('driver_shipments_total_orders') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="total_orders" type="number" value="{{ request()->total_orders }}"  placeholder="{{ __('driver_shipments_total_orders') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_shipments-list-delivered_orders">{{ __('driver_shipments_delivered_orders') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="delivered_orders" type="number" value="{{ request()->delivered_orders }}"  placeholder="{{ __('driver_shipments_delivered_orders') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_shipments-list-not_delivered_orders">{{ __('driver_shipments_not_delivered_orders') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="not_delivered_orders" type="number" value="{{ request()->not_delivered_orders }}"  placeholder="{{ __('driver_shipments_not_delivered_orders') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_shipments-list-return_reasons">{{ __('driver_shipments_return_reasons') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="return_reasons" value="{{ request()->return_reasons }}"  type="text" placeholder="{{ __('driver_shipments_return_reasons') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_shipments-list-orders_date">{{ __('driver_shipments_orders_date') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="orders_date" type="date" value="{{ request()->orders_date }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_shipments-list-created_at">{{ __('driver_shipments_created_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="created_at" type="date" value="{{ request()->created_at }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_shipments-list-updated_at">{{ __('driver_shipments_updated_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="updated_at" type="date" value="{{ request()->updated_at }}"  />

                                                </fieldset>
                                            </div>
 <div class=" mt-3">
                                                <button type="submit" class="btn btn-info" >{{ __('Find') }}</button>
                                                <a href="{{ route('driver_shipments.index') }}" class="btn btn-link" >{{ __('Reset') }}</a>
                                            </div>
            </div>
                                    </form>
                                </div>
                            </div>
                              </div>
