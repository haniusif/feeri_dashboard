@extends('layouts.layoutMaster')
@section('title', __('Projects') )
@section('vendor-style')
@vite(['resources/assets/vendor/libs/select2/select2.scss', 'resources/assets/vendor/libs/tagify/tagify.scss', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss', 'resources/assets/vendor/libs/typeahead-js/typeahead.scss', 'resources/assets/vendor/libs/animate-css/animate.scss', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'])
@endsection
@section('vendor-script')
    @vite(['resources/assets/vendor/libs/select2/select2.js', 'resources/assets/vendor/libs/tagify/tagify.js', 'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js', 'resources/assets/vendor/libs/typeahead-js/typeahead.js', 'resources/assets/vendor/libs/bloodhound/bloodhound.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection
@section('page-script')
    @vite(['resources/assets/js/forms-selects.js', 'resources/assets/js/forms-tagify.js', 'resources/assets/js/forms-typeahead.js'])
   <script>
        'use strict';
        // Reusable function to show confirmation alert
        function showConfirmation(button) {
            Swal.fire({
                title: "{{ __('Are you sure?') }}",
                text: "{{ __('You wont be able to revert this!') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes, delete it!') }}",
                customClass: {
                    confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                    cancelButton: 'btn btn-label-secondary waves-effect waves-light'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    // Access the value of the button that triggered the function
                    var id = button.value;
                    document.getElementById('destroy-project_'+id).submit();

                }
            });
        }
    </script>
@if (request()->session()->exists('message'))
<script>
        Swal.fire({
      position: 'top-end',
      type: 'success',
      html: '{!! session('message') !!}',
      showConfirmButton: false,
      timer: 3000,
      confirmButtonClass: 'btn btn-primary',
      buttonsStyling: false,
    })
</script>
   @endif
@endsection
@section('content')
<div class="row">
 <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
            </li>
            <li class="breadcrumb-item active">{{ __('Projects') }}
            </li>
        </ol>
    </div>
     @include('_partials.alerts')
     @include('FEERI.projects.search.search')
    <div class="col-12">
    <div class="card">
                    <div class="card-body">
                      <div class="card-title header-elements">
                        <h5 class="m-0 me-2">{{ __('Projects') }}</h5>
                        @can('create projects')
                        <div class="card-title-elements ms-auto">
                         <a  href="{{ route('projects.create') }}" class="btn btn-xs btn-primary waves-effect waves-light">
                          <span class="tf-icon ti ti-plus ti-xs me-1"></span>{{ __('Add new') }}
                        </a>

                        </div>
                        @endcan
                      </div>
                <div class="table-responsive mt-1">
                    <table class="table table-hover-animation mb-0">
                        <thead>
                            <tr>
                                <th>#</th>

<th  >{{ __('projects_name') }}</th>
<th  >{{ __('projects_en_name') }}</th>
<th  >{{ __('projects_logo') }}</th>
<th  >{{ __('projects_contact_name') }}</th>
<th  >{{ __('projects_contact_email') }}</th>
<th  >{{ __('projects_contact_phone_number') }}</th>
<th  >{{ __('projects_tax_number') }}</th>
<th  >{{ __('projects_cr_number') }}</th>
<th  >{{ __('projects_address') }}</th>
<th  >{{ __('projects_project_status_id') }}</th>
<th  >{{ __('projects_is_active') }}</th>
<th  >{{ __('projects_created_at') }}</th>
<th  >{{ __('projects_updated_at') }}</th> <th >{{ __('Action') }}</th>
    </tr>
     </thead>
          <tbody>
          @foreach ($projects as $key => $project)
            <tr>
            <td>{{ $project->firstItem + $key + 1 }}</td>
            
<td>{{ $project->name }}</td>
<td>{{ $project->en_name }}</td>
<td>
<img src="{{ $project->logo }}" higth="100" width="100">
 </td>
<td>{{ $project->contact_name }}</td>
<td>{{ $project->contact_email }}</td>
<td>{{ $project->contact_phone_number }}</td>
<td>{{ $project->tax_number }}</td>
<td>{{ $project->cr_number }}</td>
<td>{{ $project->address }}</td>
<td>{{ $project->project_status_id }}</td>
<td>
<span class="badge bg-label-{{ ($project->is_active == 1) ? __("success") : __("danger") }} ">
{{ ($project->is_active == 1) ? __("YES") : __("NO") }}
</span>
</td>
<td>{{ $project->created_at }}</td>
<td>{{ $project->updated_at }}</td>         <td>
           <a href="{{ route('projects.show', $project->id) }}"
                                                    class="btn btn-success mr-1 mb-1 btn-sm"><i
                                                        class="ti ti-eye"></i></a>
            <button value="{{  $project->id }}" class="btn btn-danger mr-1 mb-1 btn-sm "  onclick="showConfirmation(this)"   ><i class="ti ti-trash"></i></button>
                                                <form id="destroy-project_{{  $project->id }}"
                                                    action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                                    style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
           </td>
        </tr>
 @endforeach
   </tbody>
        <tfoot>
       <tr><td      colspan="14"  >{{$projects->links("pagination::bootstrap-4")}} </td></tr>
        </tfoot>
</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   @stop
                          
