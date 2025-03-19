 <div class="col-12">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">{{ __('Filters') }}</h4>
                <form action="{{ route('driver_bank_accounts.index') }}" method="GET">
                    <div class="row">




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_bank_accounts-list-driver_id">{{ __('driver_bank_accounts_driver_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="driver_id"  class="form-control" id="driver_bank_accounts-list-driver_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($drivers as $driver)
                             <option   @selected(request()->driver_id == $driver->id)     value="{{ $driver->id }}" >{{ $driver->full_name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_bank_accounts-list-bank_id">{{ __('driver_bank_accounts_bank_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="bank_id"  class="form-control" id="driver_bank_accounts-list-bank_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($banks as $bank)
                             <option   @selected(request()->bank_id == $bank->id)     value="{{ $bank->id }}" >{{ $bank->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_bank_accounts-list-account_number">{{ __('driver_bank_accounts_account_number') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="account_number" type="number" value="{{ request()->account_number }}"  placeholder="{{ __('driver_bank_accounts_account_number') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_bank_accounts-list-ipan">{{ __('driver_bank_accounts_ipan') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="ipan" value="{{ request()->ipan }}"  type="text" placeholder="{{ __('driver_bank_accounts_ipan') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_bank_accounts-list-is_default">{{ __('driver_bank_accounts_is_default') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="is_default" class="form-control" id="driver_bank_accounts-list-is_default">

                                                        <option value="all" @if(request()->is_default == 'all') selected @endif >{{ __('All') }}</option>
                                                        <option value="1" @if(request()->is_default == '1') selected @endif >{{ __('YES') }}</option>
                                                        <option value="0" @if(request()->is_default == '0') selected @endif >{{ __('NO') }}</option>



                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_bank_accounts-list-created_at">{{ __('driver_bank_accounts_created_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="created_at" type="date" value="{{ request()->created_at }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="driver_bank_accounts-list-updated_at">{{ __('driver_bank_accounts_updated_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="updated_at" type="date" value="{{ request()->updated_at }}"  />

                                                </fieldset>
                                            </div>
 <div class=" mt-3">
                                                <button type="submit" class="btn btn-info" >{{ __('Find') }}</button>
                                                <a href="{{ route('driver_bank_accounts.index') }}" class="btn btn-link" >{{ __('Reset') }}</a>
                                            </div>
            </div>
                                    </form>
                                </div>
                            </div>
                              </div>
