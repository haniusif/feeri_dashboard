 <div class="col-12">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">{{ __('Filters') }}</h4>
                <form action="{{ route('order_packages.index') }}" method="GET">
                    <div class="row">




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_packages-list-order_id">{{ __('order_packages_order_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="order_id"  class="form-control" id="order_packages-list-order_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($orders as $order)
                             <option   @selected(request()->order_id == $order->id)     value="{{ $order->id }}" >{{ $order->order_reference }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_packages-list-package_name">{{ __('order_packages_package_name') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="package_name" value="{{ request()->package_name }}"  type="text" placeholder="{{ __('order_packages_package_name') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_packages-list-package_description">{{ __('order_packages_package_description') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="package_description" value="{{ request()->package_description }}"  type="text" placeholder="{{ __('order_packages_package_description') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_packages-list-package_weight">{{ __('order_packages_package_weight') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="package_weight" type="number" value="{{ request()->package_weight }}"  placeholder="{{ __('order_packages_package_weight') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_packages-list-package_length">{{ __('order_packages_package_length') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="package_length" type="number" value="{{ request()->package_length }}"  placeholder="{{ __('order_packages_package_length') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_packages-list-package_width">{{ __('order_packages_package_width') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="package_width" type="number" value="{{ request()->package_width }}"  placeholder="{{ __('order_packages_package_width') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_packages-list-package_height">{{ __('order_packages_package_height') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="package_height" type="number" value="{{ request()->package_height }}"  placeholder="{{ __('order_packages_package_height') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_packages-list-package_weight_vol">{{ __('order_packages_package_weight_vol') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="package_weight_vol" type="number" value="{{ request()->package_weight_vol }}"  placeholder="{{ __('order_packages_package_weight_vol') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_packages-list-created_at">{{ __('order_packages_created_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="created_at" type="date" value="{{ request()->created_at }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="order_packages-list-updated_at">{{ __('order_packages_updated_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="updated_at" type="date" value="{{ request()->updated_at }}"  />

                                                </fieldset>
                                            </div>
 <div class=" mt-3">
                                                <button type="submit" class="btn btn-info" >{{ __('Find') }}</button>
                                                <a href="{{ route('order_packages.index') }}" class="btn btn-link" >{{ __('Reset') }}</a>
                                            </div>
            </div>
                                    </form>
                                </div>
                            </div>
                              </div>
