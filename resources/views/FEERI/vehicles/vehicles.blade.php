@extends('layouts.layoutMaster')
@section('title', __('Vehicles') )
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
                    document.getElementById('destroy-vehicle_'+id).submit();

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
            <li class="breadcrumb-item active">{{ __('Vehicles') }}
            </li>
        </ol>
    </div>
     @include('_partials.alerts')
     @include('FEERI.vehicles.search.search')
    <div class="col-12">
    <div class="card">
                    <div class="card-body">
                      <div class="card-title header-elements">
                        <h5 class="m-0 me-2">{{ __('Vehicles') }}</h5>
                        @can('create vehicles')
                        <div class="card-title-elements ms-auto">
                         <a  href="{{ route('vehicles.create') }}" class="btn btn-xs btn-primary waves-effect waves-light">
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

<th  >{{ __('vehicles_plate_number') }}</th>
<th  >{{ __('vehicles_serial_number') }}</th>
<th  >{{ __('vehicles_chassis_number') }}</th>
<th  >{{ __('vehicles_registration_number') }}</th>
<th  >{{ __('vehicles_form_expiration') }}</th>
<th  >{{ __('vehicles_plate_registration_type_id') }}</th>
<th  >{{ __('vehicles_vehicle_manufacturer_id') }}</th>
<th  >{{ __('vehicles_vehicle_manufacturer_year') }}</th>
<th  >{{ __('vehicles_vehicle_model_id') }}</th>
<th  >{{ __('vehicles_vehicle_color_id') }}</th>
<th  >{{ __('vehicles_vehicle_status_id') }}</th>
<th  >{{ __('vehicles_vehicle_type_id') }}</th>
<th  >{{ __('vehicles_vehicle_supplier_id') }}</th>
<th  >{{ __('vehicles_ownership_date') }}</th>
<th  >{{ __('vehicles_created_at') }}</th>
<th  >{{ __('vehicles_updated_at') }}</th> <th >{{ __('Action') }}</th>
    </tr>
     </thead>
          <tbody>
          @foreach ($vehicles as $key => $vehicle)
            <tr>
            <td>{{ $vehicle->firstItem + $key + 1 }}</td>
            
<td>{{ $vehicle->plate_number }}</td>
<td>{{ $vehicle->serial_number }}</td>
<td>{{ $vehicle->chassis_number }}</td>
<td>{{ $vehicle->registration_number }}</td>
<td>{{ $vehicle->form_expiration }}</td>
<td>{{ $vehicle->plate_registration_type_id }}</td>
<td>{{ $vehicle->vehicle_manufacturer_id }}</td>
<td>{{ $vehicle->vehicle_manufacturer_year }}</td>
<td>{{ $vehicle->vehicle_model_id }}</td>
<td>{{ $vehicle->vehicle_color_id }}</td>
<td>{{ $vehicle->vehicle_status_id }}</td>
<td>{{ $vehicle->vehicle_type_id }}</td>
<td>{{ $vehicle->vehicle_supplier_id }}</td>
<td>{{ $vehicle->ownership_date }}</td>
<td>{{ $vehicle->created_at }}</td>
<td>{{ $vehicle->updated_at }}</td>         <td>
           <a href="{{ route('vehicles.show', $vehicle->id) }}"
                                                    class="btn btn-success mr-1 mb-1 btn-sm"><i
                                                        class="ti ti-eye"></i></a>
            <button value="{{  $vehicle->id }}" class="btn btn-danger mr-1 mb-1 btn-sm "  onclick="showConfirmation(this)"   ><i class="ti ti-trash"></i></button>
                                                <form id="destroy-vehicle_{{  $vehicle->id }}"
                                                    action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST"
                                                    style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
           </td>
        </tr>
 @endforeach
   </tbody>
        <tfoot>
       <tr><td      colspan="17"  >{{$vehicles->links("pagination::bootstrap-4")}} </td></tr>
        </tfoot>
</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   @stop
                                
