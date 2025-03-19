 <div class="col-12">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">{{ __('Filters') }}</h4>
                <form action="{{ route('drivers.index') }}" method="GET">
                    <div class="row">

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-full_name">{{ __('drivers_full_name') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="full_name" value="{{ request()->full_name }}"  type="text" placeholder="{{ __('drivers_full_name') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-en_full_name">{{ __('drivers_en_full_name') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="en_full_name" value="{{ request()->en_full_name }}"  type="text" placeholder="{{ __('drivers_en_full_name') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-phone_number">{{ __('drivers_phone_number') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="phone_number" value="{{ request()->phone_number }}"  type="text" placeholder="{{ __('drivers_phone_number') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-id_number">{{ __('drivers_id_number') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="id_number" value="{{ request()->id_number }}"  type="text" placeholder="{{ __('drivers_id_number') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-id_expiry_at">{{ __('drivers_id_expiry_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="id_expiry_at" type="date" value="{{ request()->id_expiry_at }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-dob">{{ __('drivers_dob') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="dob" type="date" value="{{ request()->dob }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-image">{{ __('drivers_image') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="image" value="{{ request()->image }}"  type="text" placeholder="{{ __('drivers_image') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-license_number">{{ __('drivers_license_number') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="license_number" value="{{ request()->license_number }}"  type="text" placeholder="{{ __('drivers_license_number') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-license_expiry_at">{{ __('drivers_license_expiry_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="license_expiry_at" type="date" value="{{ request()->license_expiry_at }}"  />

                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-nationality_id">{{ __('drivers_nationality_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="nationality_id"  class="form-control" id="drivers-list-nationality_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($nationalities as $nationality)
                             <option   @selected(request()->nationality_id == $nationality->id)     value="{{ $nationality->id }}" >{{ $nationality->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-driver_contract_type_id">{{ __('drivers_driver_contract_type_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="driver_contract_type_id"  class="form-control" id="drivers-list-driver_contract_type_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($driver_contract_types as $driver_contract_type)
                             <option   @selected(request()->driver_contract_type_id == $driver_contract_type->id)     value="{{ $driver_contract_type->id }}" >{{ $driver_contract_type->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-current_vehicle_id">{{ __('drivers_current_vehicle_id') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="current_vehicle_id" type="number" value="{{ request()->current_vehicle_id }}"  placeholder="{{ __('drivers_current_vehicle_id') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-current_project_id">{{ __('drivers_current_project_id') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="current_project_id" type="number" value="{{ request()->current_project_id }}"  placeholder="{{ __('drivers_current_project_id') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-address">{{ __('drivers_address') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="address" value="{{ request()->address }}"  type="text" placeholder="{{ __('drivers_address') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-is_active">{{ __('drivers_is_active') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="is_active" class="form-control" id="drivers-list-is_active">

                                                        <option value="all" @if(request()->is_active == 'all') selected @endif >{{ __('All') }}</option>
                                                        <option value="1" @if(request()->is_active == '1') selected @endif >{{ __('YES') }}</option>
                                                        <option value="0" @if(request()->is_active == '0') selected @endif >{{ __('NO') }}</option>



                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-created_at">{{ __('drivers_created_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="created_at" type="date" value="{{ request()->created_at }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="drivers-list-updated_at">{{ __('drivers_updated_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="updated_at" type="date" value="{{ request()->updated_at }}"  />

                                                </fieldset>
                                            </div>
 <div class=" mt-3">
                                                <button type="submit" class="btn btn-info" >{{ __('Find') }}</button>
                                                <a href="{{ route('drivers.index') }}" class="btn btn-link" >{{ __('Reset') }}</a>
                                            </div>
            </div>
                                    </form>
                                </div>
                            </div>
                              </div>
