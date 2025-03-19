 <div class="col-12">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">{{ __('Filters') }}</h4>
                <form action="{{ route('vehicle_handovers.index') }}" method="GET">
                    <div class="row">




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicle_handovers-list-driver_id">{{ __('vehicle_handovers_driver_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="driver_id"  class="form-control" id="vehicle_handovers-list-driver_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($drivers as $driver)
                             <option   @selected(request()->driver_id == $driver->id)     value="{{ $driver->id }}" >{{ $driver->full_name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicle_handovers-list-vehicle_id">{{ __('vehicle_handovers_vehicle_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="vehicle_id"  class="form-control" id="vehicle_handovers-list-vehicle_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($vehicles as $vehicle)
                             <option   @selected(request()->vehicle_id == $vehicle->id)     value="{{ $vehicle->id }}" >{{ $vehicle->plate_number }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicle_handovers-list-meter_upon_handover">{{ __('vehicle_handovers_meter_upon_handover') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="meter_upon_handover" type="number" value="{{ request()->meter_upon_handover }}"  placeholder="{{ __('vehicle_handovers_meter_upon_handover') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicle_handovers-list-authorization_start_date">{{ __('vehicle_handovers_authorization_start_date') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="authorization_start_date" type="date" value="{{ request()->authorization_start_date }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicle_handovers-list-authorization_end_date">{{ __('vehicle_handovers_authorization_end_date') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="authorization_end_date" type="date" value="{{ request()->authorization_end_date }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicle_handovers-list-front_right_image">{{ __('vehicle_handovers_front_right_image') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="front_right_image" value="{{ request()->front_right_image }}"  type="text" placeholder="{{ __('vehicle_handovers_front_right_image') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicle_handovers-list-back_left_image">{{ __('vehicle_handovers_back_left_image') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="back_left_image" value="{{ request()->back_left_image }}"  type="text" placeholder="{{ __('vehicle_handovers_back_left_image') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicle_handovers-list-created_at">{{ __('vehicle_handovers_created_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="created_at" type="date" value="{{ request()->created_at }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicle_handovers-list-updated_at">{{ __('vehicle_handovers_updated_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="updated_at" type="date" value="{{ request()->updated_at }}"  />

                                                </fieldset>
                                            </div>
 <div class=" mt-3">
                                                <button type="submit" class="btn btn-info" >{{ __('Find') }}</button>
                                                <a href="{{ route('vehicle_handovers.index') }}" class="btn btn-link" >{{ __('Reset') }}</a>
                                            </div>
            </div>
                                    </form>
                                </div>
                            </div>
                              </div>
