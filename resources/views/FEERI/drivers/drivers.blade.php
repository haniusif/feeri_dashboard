@extends('layouts.layoutMaster')
@section('title', __('Drivers') )
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
                    document.getElementById('destroy-driver_'+id).submit();

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
            <li class="breadcrumb-item active">{{ __('Drivers') }}
            </li>
        </ol>
    </div>
     @include('_partials.alerts')
     @include('FEERI.drivers.search.search')
    <div class="col-12">
    <div class="card">
                    <div class="card-body">
                      <div class="card-title header-elements">
                        <h5 class="m-0 me-2">{{ __('Drivers') }}</h5>
                        @can('create drivers')
                        <div class="card-title-elements ms-auto">
                         <a  href="{{ route('drivers.create') }}" class="btn btn-xs btn-primary waves-effect waves-light">
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

<th  >{{ __('drivers_full_name') }}</th>
<th  >{{ __('drivers_en_full_name') }}</th>
<th  >{{ __('drivers_phone_number') }}</th>
<th  >{{ __('drivers_id_number') }}</th>
<th  >{{ __('drivers_id_expiry_at') }}</th>
<th  >{{ __('drivers_dob') }}</th>
<th  >{{ __('drivers_image') }}</th>
<th  >{{ __('drivers_license_number') }}</th>
<th  >{{ __('drivers_license_expiry_at') }}</th>
<th  >{{ __('drivers_nationality_id') }}</th>
<th  >{{ __('drivers_driver_contract_type_id') }}</th>
<th  >{{ __('drivers_current_vehicle_id') }}</th>
<th  >{{ __('drivers_current_project_id') }}</th>
<th  >{{ __('drivers_address') }}</th>
<th  >{{ __('drivers_is_active') }}</th>
<th  >{{ __('drivers_created_at') }}</th>
<th  >{{ __('drivers_updated_at') }}</th> <th >{{ __('Action') }}</th>
    </tr>
     </thead>
          <tbody>
          @foreach ($drivers as $key => $driver)
            <tr>
            <td>{{ $driver->firstItem + $key + 1 }}</td>
            
<td>{{ $driver->full_name }}</td>
<td>{{ $driver->en_full_name }}</td>
<td>{{ $driver->phone_number }}</td>
<td>{{ $driver->id_number }}</td>
<td>{{ $driver->id_expiry_at }}</td>
<td>{{ $driver->dob }}</td>
<td>
<img src="{{ $driver->image }}" higth="100" width="100">
 </td>
<td>{{ $driver->license_number }}</td>
<td>{{ $driver->license_expiry_at }}</td>
<td>{{ $driver->nationality_id }}</td>
<td>{{ $driver->driver_contract_type_id }}</td>
<td>{{ $driver->current_vehicle_id }}</td>
<td>{{ $driver->current_project_id }}</td>
<td>{{ $driver->address }}</td>
<td>
<span class="badge bg-label-{{ ($driver->is_active == 1) ? __("success") : __("danger") }} ">
{{ ($driver->is_active == 1) ? __("YES") : __("NO") }}
</span>
</td>
<td>{{ $driver->created_at }}</td>
<td>{{ $driver->updated_at }}</td>         <td>
           <a href="{{ route('drivers.show', $driver->id) }}"
                                                    class="btn btn-success mr-1 mb-1 btn-sm"><i
                                                        class="ti ti-eye"></i></a>
            <button value="{{  $driver->id }}" class="btn btn-danger mr-1 mb-1 btn-sm "  onclick="showConfirmation(this)"   ><i class="ti ti-trash"></i></button>
                                                <form id="destroy-driver_{{  $driver->id }}"
                                                    action="{{ route('drivers.destroy', $driver->id) }}" method="POST"
                                                    style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
           </td>
        </tr>
 @endforeach
   </tbody>
        <tfoot>
       <tr><td      colspan="18"  >{{$drivers->links("pagination::bootstrap-4")}} </td></tr>
        </tfoot>
</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   @stop
                                  
