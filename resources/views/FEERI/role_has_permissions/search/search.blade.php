 <div class="col-12">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">{{ __('Filters') }}</h4>
                <form action="{{ route('role_has_permissions.index') }}" method="GET">
                    <div class="row">




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="role_has_permissions-list-permission_id">{{ __('role_has_permissions_permission_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="permission_id"  class="form-control" id="role_has_permissions-list-permission_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($permissions as $permission)
                             <option   @selected(request()->permission_id == $permission->id)     value="{{ $permission->id }}" >{{ $permission->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="role_has_permissions-list-role_id">{{ __('role_has_permissions_role_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="role_id"  class="form-control" id="role_has_permissions-list-role_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($roles as $role)
                             <option   @selected(request()->role_id == $role->id)     value="{{ $role->id }}" >{{ $role->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>
 <div class=" mt-3">
                                                <button type="submit" class="btn btn-info" >{{ __('Find') }}</button>
                                                <a href="{{ route('role_has_permissions.index') }}" class="btn btn-link" >{{ __('Reset') }}</a>
                                            </div>
            </div>
                                    </form>
                                </div>
                            </div>
                              </div>
