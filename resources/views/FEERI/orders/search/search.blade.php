 <div class="col-12">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">{{ __('Filters') }}</h4>
                <form action="{{ route('orders.index') }}" method="GET">
                    <div class="row">

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-order_reference">{{ __('orders_order_reference') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="order_reference" value="{{ request()->order_reference }}"  type="text" placeholder="{{ __('orders_order_reference') }}"  />

                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-order_status_id">{{ __('orders_order_status_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="order_status_id"  class="form-control" id="orders-list-order_status_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($order_statuses as $order_status)
                             <option   @selected(request()->order_status_id == $order_status->id)     value="{{ $order_status->id }}" >{{ $order_status->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-user_id">{{ __('orders_user_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="user_id"  class="form-control" id="orders-list-user_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($users as $user)
                             <option   @selected(request()->user_id == $user->id)     value="{{ $user->id }}" >{{ $user->first_name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-cod_amount">{{ __('orders_cod_amount') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="cod_amount" type="number" value="{{ request()->cod_amount }}"  placeholder="{{ __('orders_cod_amount') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-pickup_reference">{{ __('orders_pickup_reference') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="pickup_reference" value="{{ request()->pickup_reference }}"  type="text" placeholder="{{ __('orders_pickup_reference') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-pickup_name">{{ __('orders_pickup_name') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="pickup_name" value="{{ request()->pickup_name }}"  type="text" placeholder="{{ __('orders_pickup_name') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-pickup_phone_number">{{ __('orders_pickup_phone_number') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="pickup_phone_number" value="{{ request()->pickup_phone_number }}"  type="text" placeholder="{{ __('orders_pickup_phone_number') }}"  />

                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-pickup_country_id">{{ __('orders_pickup_country_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="pickup_country_id"  class="form-control" id="orders-list-pickup_country_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($countries as $country)
                             <option   @selected(request()->pickup_country_id == $country->id)     value="{{ $country->id }}" >{{ $country->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-pickup_city_id">{{ __('orders_pickup_city_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="pickup_city_id"  class="form-control" id="orders-list-pickup_city_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($cities as $city)
                             <option   @selected(request()->pickup_city_id == $city->id)     value="{{ $city->id }}" >{{ $city->country_id }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-pickup_neighbourhood_id">{{ __('orders_pickup_neighbourhood_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="pickup_neighbourhood_id"  class="form-control" id="orders-list-pickup_neighbourhood_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($neighbourhoods as $neighbourhood)
                             <option   @selected(request()->pickup_neighbourhood_id == $neighbourhood->id)     value="{{ $neighbourhood->id }}" >{{ $neighbourhood->city_id }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-pickup_address">{{ __('orders_pickup_address') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="pickup_address" value="{{ request()->pickup_address }}"  type="text" placeholder="{{ __('orders_pickup_address') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-pickup_latitude">{{ __('orders_pickup_latitude') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="pickup_latitude" value="{{ request()->pickup_latitude }}"  type="text" placeholder="{{ __('orders_pickup_latitude') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-pickup_longitude">{{ __('orders_pickup_longitude') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="pickup_longitude" value="{{ request()->pickup_longitude }}"  type="text" placeholder="{{ __('orders_pickup_longitude') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-pickup_time">{{ __('orders_pickup_time') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="pickup_time" type="date" value="{{ request()->pickup_time }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-dropoff_reference">{{ __('orders_dropoff_reference') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="dropoff_reference" value="{{ request()->dropoff_reference }}"  type="text" placeholder="{{ __('orders_dropoff_reference') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-dropoff_name">{{ __('orders_dropoff_name') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="dropoff_name" value="{{ request()->dropoff_name }}"  type="text" placeholder="{{ __('orders_dropoff_name') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-dropoff_phone_number">{{ __('orders_dropoff_phone_number') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="dropoff_phone_number" value="{{ request()->dropoff_phone_number }}"  type="text" placeholder="{{ __('orders_dropoff_phone_number') }}"  />

                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-dropoff_country_id">{{ __('orders_dropoff_country_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="dropoff_country_id"  class="form-control" id="orders-list-dropoff_country_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($countries as $country)
                             <option   @selected(request()->dropoff_country_id == $country->id)     value="{{ $country->id }}" >{{ $country->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-dropoff_city_id">{{ __('orders_dropoff_city_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="dropoff_city_id"  class="form-control" id="orders-list-dropoff_city_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($cities as $city)
                             <option   @selected(request()->dropoff_city_id == $city->id)     value="{{ $city->id }}" >{{ $city->country_id }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-dropoff_neighbourhood_id">{{ __('orders_dropoff_neighbourhood_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="dropoff_neighbourhood_id"  class="form-control" id="orders-list-dropoff_neighbourhood_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($neighbourhoods as $neighbourhood)
                             <option   @selected(request()->dropoff_neighbourhood_id == $neighbourhood->id)     value="{{ $neighbourhood->id }}" >{{ $neighbourhood->city_id }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-dropoff_address">{{ __('orders_dropoff_address') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="dropoff_address" value="{{ request()->dropoff_address }}"  type="text" placeholder="{{ __('orders_dropoff_address') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-dropoff_latitude">{{ __('orders_dropoff_latitude') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="dropoff_latitude" value="{{ request()->dropoff_latitude }}"  type="text" placeholder="{{ __('orders_dropoff_latitude') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-dropoff_longitude">{{ __('orders_dropoff_longitude') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="dropoff_longitude" value="{{ request()->dropoff_longitude }}"  type="text" placeholder="{{ __('orders_dropoff_longitude') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-dropoff_time">{{ __('orders_dropoff_time') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="dropoff_time" type="date" value="{{ request()->dropoff_time }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-created_at">{{ __('orders_created_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="created_at" type="date" value="{{ request()->created_at }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="orders-list-updated_at">{{ __('orders_updated_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="updated_at" type="date" value="{{ request()->updated_at }}"  />

                                                </fieldset>
                                            </div>
 <div class=" mt-3">
                                                <button type="submit" class="btn btn-info" >{{ __('Find') }}</button>
                                                <a href="{{ route('orders.index') }}" class="btn btn-link" >{{ __('Reset') }}</a>
                                            </div>
            </div>
                                    </form>
                                </div>
                            </div>
                              </div>
