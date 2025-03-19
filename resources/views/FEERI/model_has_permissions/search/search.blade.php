 <div class="col-12">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">{{ __('Filters') }}</h4>
                <form action="{{ route('model_has_permissions.index') }}" method="GET">
                    <div class="row">




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="model_has_permissions-list-permission_id">{{ __('model_has_permissions_permission_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="permission_id"  class="form-control" id="model_has_permissions-list-permission_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($permissions as $permission)
                             <option   @selected(request()->permission_id == $permission->id)     value="{{ $permission->id }}" >{{ $permission->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="model_has_permissions-list-model_type">{{ __('model_has_permissions_model_type') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="model_type" value="{{ request()->model_type }}"  type="text" placeholder="{{ __('model_has_permissions_model_type') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="model_has_permissions-list-model_id">{{ __('model_has_permissions_model_id') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="model_id" type="number" value="{{ request()->model_id }}"  placeholder="{{ __('model_has_permissions_model_id') }}"  />

                                                </fieldset>
                                            </div>
 <div class=" mt-3">
                                                <button type="submit" class="btn btn-info" >{{ __('Find') }}</button>
                                                <a href="{{ route('model_has_permissions.index') }}" class="btn btn-link" >{{ __('Reset') }}</a>
                                            </div>
            </div>
                                    </form>
                                </div>
                            </div>
                              </div>
