 <div class="col-12">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">{{ __('Filters') }}</h4>
                <form action="{{ route('customer_addresses.index') }}" method="GET">
                    <div class="row">




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="customer_addresses-list-user_id">{{ __('customer_addresses_user_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="user_id"  class="form-control" id="customer_addresses-list-user_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($users as $user)
                             <option   @selected(request()->user_id == $user->id)     value="{{ $user->id }}" >{{ $user->first_name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="customer_addresses-list-country_id">{{ __('customer_addresses_country_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="country_id"  class="form-control" id="customer_addresses-list-country_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($countries as $country)
                             <option   @selected(request()->country_id == $country->id)     value="{{ $country->id }}" >{{ $country->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="customer_addresses-list-city_id">{{ __('customer_addresses_city_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="city_id"  class="form-control" id="customer_addresses-list-city_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($cities as $city)
                             <option   @selected(request()->city_id == $city->id)     value="{{ $city->id }}" >{{ $city->country_id }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="customer_addresses-list-neighbourhood_id">{{ __('customer_addresses_neighbourhood_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="neighbourhood_id"  class="form-control" id="customer_addresses-list-neighbourhood_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($neighbourhoods as $neighbourhood)
                             <option   @selected(request()->neighbourhood_id == $neighbourhood->id)     value="{{ $neighbourhood->id }}" >{{ $neighbourhood->city_id }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="customer_addresses-list-location_lat">{{ __('customer_addresses_location_lat') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="location_lat" value="{{ request()->location_lat }}"  type="text" placeholder="{{ __('customer_addresses_location_lat') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="customer_addresses-list-location_lanf">{{ __('customer_addresses_location_lanf') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="location_lanf" value="{{ request()->location_lanf }}"  type="text" placeholder="{{ __('customer_addresses_location_lanf') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="customer_addresses-list-zip_code">{{ __('customer_addresses_zip_code') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="zip_code" value="{{ request()->zip_code }}"  type="text" placeholder="{{ __('customer_addresses_zip_code') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="customer_addresses-list-address">{{ __('customer_addresses_address') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="address" value="{{ request()->address }}"  type="text" placeholder="{{ __('customer_addresses_address') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="customer_addresses-list-is_default">{{ __('customer_addresses_is_default') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="is_default" class="form-control" id="customer_addresses-list-is_default">

                                                        <option value="all" @if(request()->is_default == 'all') selected @endif >{{ __('All') }}</option>
                                                        <option value="1" @if(request()->is_default == '1') selected @endif >{{ __('YES') }}</option>
                                                        <option value="0" @if(request()->is_default == '0') selected @endif >{{ __('NO') }}</option>



                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="customer_addresses-list-created_at">{{ __('customer_addresses_created_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="created_at" type="date" value="{{ request()->created_at }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="customer_addresses-list-updated_at">{{ __('customer_addresses_updated_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="updated_at" type="date" value="{{ request()->updated_at }}"  />

                                                </fieldset>
                                            </div>
 <div class=" mt-3">
                                                <button type="submit" class="btn btn-info" >{{ __('Find') }}</button>
                                                <a href="{{ route('customer_addresses.index') }}" class="btn btn-link" >{{ __('Reset') }}</a>
                                            </div>
            </div>
                                    </form>
                                </div>
                            </div>
                              </div>
