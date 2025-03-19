 <div class="col-12">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">{{ __('Filters') }}</h4>
                <form action="{{ route('users.index') }}" method="GET">
                    <div class="row">

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="users-list-first_name">{{ __('users_first_name') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="first_name" value="{{ request()->first_name }}"  type="text" placeholder="{{ __('users_first_name') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="users-list-last_name">{{ __('users_last_name') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="last_name" value="{{ request()->last_name }}"  type="text" placeholder="{{ __('users_last_name') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="users-list-phone_number">{{ __('users_phone_number') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="phone_number" value="{{ request()->phone_number }}"  type="text" placeholder="{{ __('users_phone_number') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="users-list-email">{{ __('users_email') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="email" value="{{ request()->email }}"  type="text" placeholder="{{ __('users_email') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="users-list-user_type">{{ __('users_user_type') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="user_type" value="{{ request()->user_type }}"  type="text" placeholder="{{ __('users_user_type') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="users-list-is_active">{{ __('users_is_active') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="is_active" class="form-control" id="users-list-is_active">

                                                        <option value="all" @if(request()->is_active == 'all') selected @endif >{{ __('All') }}</option>
                                                        <option value="1" @if(request()->is_active == '1') selected @endif >{{ __('YES') }}</option>
                                                        <option value="0" @if(request()->is_active == '0') selected @endif >{{ __('NO') }}</option>



                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="users-list-is_verified">{{ __('users_is_verified') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="is_verified" class="form-control" id="users-list-is_verified">

                                                        <option value="all" @if(request()->is_verified == 'all') selected @endif >{{ __('All') }}</option>
                                                        <option value="1" @if(request()->is_verified == '1') selected @endif >{{ __('YES') }}</option>
                                                        <option value="0" @if(request()->is_verified == '0') selected @endif >{{ __('NO') }}</option>



                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="users-list-created_at">{{ __('users_created_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="created_at" type="date" value="{{ request()->created_at }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="users-list-updated_at">{{ __('users_updated_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="updated_at" type="date" value="{{ request()->updated_at }}"  />

                                                </fieldset>
                                            </div>
 <div class=" mt-3">
                                                <button type="submit" class="btn btn-info" >{{ __('Find') }}</button>
                                                <a href="{{ route('users.index') }}" class="btn btn-link" >{{ __('Reset') }}</a>
                                            </div>
            </div>
                                    </form>
                                </div>
                            </div>
                              </div>
