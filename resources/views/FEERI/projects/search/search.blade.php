 <div class="col-12">
<div class="card mb-4">
  <div class="card-body">
    <h4 class="card-title">{{ __('Filters') }}</h4>
                <form action="{{ route('projects.index') }}" method="GET">
                    <div class="row">

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="projects-list-name">{{ __('projects_name') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="name" value="{{ request()->name }}"  type="text" placeholder="{{ __('projects_name') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="projects-list-en_name">{{ __('projects_en_name') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="en_name" value="{{ request()->en_name }}"  type="text" placeholder="{{ __('projects_en_name') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="projects-list-logo">{{ __('projects_logo') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="logo" value="{{ request()->logo }}"  type="text" placeholder="{{ __('projects_logo') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="projects-list-contact_name">{{ __('projects_contact_name') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="contact_name" value="{{ request()->contact_name }}"  type="text" placeholder="{{ __('projects_contact_name') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="projects-list-contact_email">{{ __('projects_contact_email') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="contact_email" value="{{ request()->contact_email }}"  type="text" placeholder="{{ __('projects_contact_email') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="projects-list-contact_phone_number">{{ __('projects_contact_phone_number') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="contact_phone_number" value="{{ request()->contact_phone_number }}"  type="text" placeholder="{{ __('projects_contact_phone_number') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="projects-list-tax_number">{{ __('projects_tax_number') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="tax_number" value="{{ request()->tax_number }}"  type="text" placeholder="{{ __('projects_tax_number') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="projects-list-cr_number">{{ __('projects_cr_number') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="cr_number" value="{{ request()->cr_number }}"  type="text" placeholder="{{ __('projects_cr_number') }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="projects-list-address">{{ __('projects_address') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="address" value="{{ request()->address }}"  type="text" placeholder="{{ __('projects_address') }}"  />

                                                </fieldset>
                                            </div>




                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="projects-list-project_status_id">{{ __('projects_project_status_id') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="project_status_id"  class="form-control" id="projects-list-project_status_id">
                                                        <option value="all">{{ __('All') }}</option>

                                                       @foreach($project_statuses as $project_status)
                             <option   @selected(request()->project_status_id == $project_status->id)     value="{{ $project_status->id }}" >{{ $project_status->name }}</option>
                             @endforeach

                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="projects-list-is_active">{{ __('projects_is_active') }}</label>
                                                <fieldset class="form-group">
                                                    <select  name="is_active" class="form-control" id="projects-list-is_active">

                                                        <option value="all" @if(request()->is_active == 'all') selected @endif >{{ __('All') }}</option>
                                                        <option value="1" @if(request()->is_active == '1') selected @endif >{{ __('YES') }}</option>
                                                        <option value="0" @if(request()->is_active == '0') selected @endif >{{ __('NO') }}</option>



                                                    </select>
                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="projects-list-created_at">{{ __('projects_created_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="created_at" type="date" value="{{ request()->created_at }}"  />

                                                </fieldset>
                                            </div>

                                          <div class="col-12 col-sm-6 col-lg-3">
                                                <label for="projects-list-updated_at">{{ __('projects_updated_at') }}</label>
                                                <fieldset class="form-group">
                                                    <input class="form-control" name="updated_at" type="date" value="{{ request()->updated_at }}"  />

                                                </fieldset>
                                            </div>
 <div class=" mt-3">
                                                <button type="submit" class="btn btn-info" >{{ __('Find') }}</button>
                                                <a href="{{ route('projects.index') }}" class="btn btn-link" >{{ __('Reset') }}</a>
                                            </div>
            </div>
                                    </form>
                                </div>
                            </div>
                              </div>
