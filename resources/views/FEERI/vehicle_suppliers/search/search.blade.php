 <div class="col-12">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">{{ __('Filters') }}</h4>
                <form action="{{ route('vehicle_suppliers.index') }}" method="GET">
                    <div class="row">

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicle_suppliers-list-supplier_name">{{ __('vehicle_suppliers_supplier_name') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="supplier_name" value="{{ request()->supplier_name }}"  type="text" placeholder="{{ __('vehicle_suppliers_supplier_name') }}"  />

                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicle_suppliers-list-id_type_id">{{ __('vehicle_suppliers_id_type_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="id_type_id"  class="form-control" id="vehicle_suppliers-list-id_type_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($id_types as $id_type)
                             <option   @selected(request()->id_type_id == $id_type->id)     value="{{ $id_type->id }}" >{{ $id_type->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicle_suppliers-list-id_number">{{ __('vehicle_suppliers_id_number') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="id_number" value="{{ request()->id_number }}"  type="text" placeholder="{{ __('vehicle_suppliers_id_number') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicle_suppliers-list-id_image">{{ __('vehicle_suppliers_id_image') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="id_image" value="{{ request()->id_image }}"  type="text" placeholder="{{ __('vehicle_suppliers_id_image') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicle_suppliers-list-created_at">{{ __('vehicle_suppliers_created_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="created_at" type="date" value="{{ request()->created_at }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="vehicle_suppliers-list-updated_at">{{ __('vehicle_suppliers_updated_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="updated_at" type="date" value="{{ request()->updated_at }}"  />

                                                </fieldset>
                                            </div>
 <div class=" mt-3">
                                                <button type="submit" class="btn btn-info" >{{ __('Find') }}</button>
                                                <a href="{{ route('vehicle_suppliers.index') }}" class="btn btn-link" >{{ __('Reset') }}</a>
                                            </div>
            </div>
                                    </form>
                                </div>
                            </div>
                              </div>
