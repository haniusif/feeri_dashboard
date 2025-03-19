 <div class="col-12">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">{{ __('Filters') }}</h4>
                <form action="{{ route('vehicles.index') }}" method="GET">
                    <div class="row">

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-plate_number">{{ __('vehicles_plate_number') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="plate_number" value="{{ request()->plate_number }}"  type="text" placeholder="{{ __('vehicles_plate_number') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-serial_number">{{ __('vehicles_serial_number') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="serial_number" value="{{ request()->serial_number }}"  type="text" placeholder="{{ __('vehicles_serial_number') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-chassis_number">{{ __('vehicles_chassis_number') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="chassis_number" value="{{ request()->chassis_number }}"  type="text" placeholder="{{ __('vehicles_chassis_number') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-registration_number">{{ __('vehicles_registration_number') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="registration_number" value="{{ request()->registration_number }}"  type="text" placeholder="{{ __('vehicles_registration_number') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-form_expiration">{{ __('vehicles_form_expiration') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="form_expiration" type="date" value="{{ request()->form_expiration }}"  />

                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-plate_registration_type_id">{{ __('vehicles_plate_registration_type_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="plate_registration_type_id"  class="form-control" id="vehicles-list-plate_registration_type_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($plate_registration_types as $plate_registration_type)
                             <option   @selected(request()->plate_registration_type_id == $plate_registration_type->id)     value="{{ $plate_registration_type->id }}" >{{ $plate_registration_type->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-vehicle_manufacturer_id">{{ __('vehicles_vehicle_manufacturer_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="vehicle_manufacturer_id"  class="form-control" id="vehicles-list-vehicle_manufacturer_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($vehicle_manufacturers as $vehicle_manufacturer)
                             <option   @selected(request()->vehicle_manufacturer_id == $vehicle_manufacturer->id)     value="{{ $vehicle_manufacturer->id }}" >{{ $vehicle_manufacturer->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-vehicle_manufacturer_year">{{ __('vehicles_vehicle_manufacturer_year') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="vehicle_manufacturer_year" type="number" value="{{ request()->vehicle_manufacturer_year }}"  placeholder="{{ __('vehicles_vehicle_manufacturer_year') }}"  />

                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-vehicle_model_id">{{ __('vehicles_vehicle_model_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="vehicle_model_id"  class="form-control" id="vehicles-list-vehicle_model_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($vehicle_models as $vehicle_model)
                             <option   @selected(request()->vehicle_model_id == $vehicle_model->id)     value="{{ $vehicle_model->id }}" >{{ $vehicle_model->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-vehicle_color_id">{{ __('vehicles_vehicle_color_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="vehicle_color_id"  class="form-control" id="vehicles-list-vehicle_color_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($vehicle_colors as $vehicle_color)
                             <option   @selected(request()->vehicle_color_id == $vehicle_color->id)     value="{{ $vehicle_color->id }}" >{{ $vehicle_color->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-vehicle_status_id">{{ __('vehicles_vehicle_status_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="vehicle_status_id"  class="form-control" id="vehicles-list-vehicle_status_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($vehicle_statuses as $vehicle_status)
                             <option   @selected(request()->vehicle_status_id == $vehicle_status->id)     value="{{ $vehicle_status->id }}" >{{ $vehicle_status->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-vehicle_type_id">{{ __('vehicles_vehicle_type_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="vehicle_type_id"  class="form-control" id="vehicles-list-vehicle_type_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($vehicle_types as $vehicle_type)
                             <option   @selected(request()->vehicle_type_id == $vehicle_type->id)     value="{{ $vehicle_type->id }}" >{{ $vehicle_type->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-vehicle_supplier_id">{{ __('vehicles_vehicle_supplier_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="vehicle_supplier_id"  class="form-control" id="vehicles-list-vehicle_supplier_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($vehicle_suppliers as $vehicle_supplier)
                             <option   @selected(request()->vehicle_supplier_id == $vehicle_supplier->id)     value="{{ $vehicle_supplier->id }}" >{{ $vehicle_supplier->supplier_name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-ownership_date">{{ __('vehicles_ownership_date') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="ownership_date" type="date" value="{{ request()->ownership_date }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-created_at">{{ __('vehicles_created_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="created_at" type="date" value="{{ request()->created_at }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicles-list-updated_at">{{ __('vehicles_updated_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="updated_at" type="date" value="{{ request()->updated_at }}"  />

                                                </fieldset>
                                            </div>
 <div class=" mt-3">
                                                <button type="submit" class="btn btn-info" >{{ __('Find') }}</button>
                                                <a href="{{ route('vehicles.index') }}" class="btn btn-link" >{{ __('Reset') }}</a>
                                            </div>
            </div>
                                    </form>
                                </div>
                            </div>
                              </div>
