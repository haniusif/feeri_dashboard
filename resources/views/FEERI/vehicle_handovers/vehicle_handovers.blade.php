@extends('layouts.layoutMaster')
@section('title', __('Vehicle Handovers') )
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
                    document.getElementById('destroy-vehicle_handover_'+id).submit();

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
            <li class="breadcrumb-item active">{{ __('Vehicle Handovers') }}
            </li>
        </ol>
    </div>
     @include('_partials.alerts')
     @include('FEERI.vehicle_handovers.search.search')
    <div class="col-12">
    <div class="card">
                    <div class="card-body">
                      <div class="card-title header-elements">
                        <h5 class="m-0 me-2">{{ __('Vehicle Handovers') }}</h5>
                        @can('create vehicle_handovers')
                        <div class="card-title-elements ms-auto">
                         <a  href="{{ route('vehicle_handovers.create') }}" class="btn btn-xs btn-primary waves-effect waves-light">
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

<th  >{{ __('vehicle_handovers_driver_id') }}</th>
<th  >{{ __('vehicle_handovers_vehicle_id') }}</th>
<th  >{{ __('vehicle_handovers_meter_upon_handover') }}</th>
<th  >{{ __('vehicle_handovers_authorization_start_date') }}</th>
<th  >{{ __('vehicle_handovers_authorization_end_date') }}</th>
<th  >{{ __('vehicle_handovers_front_right_image') }}</th>
<th  >{{ __('vehicle_handovers_back_left_image') }}</th>
<th  >{{ __('vehicle_handovers_created_at') }}</th>
<th  >{{ __('vehicle_handovers_updated_at') }}</th> <th >{{ __('Action') }}</th>
    </tr>
     </thead>
          <tbody>
          @foreach ($vehicle_handovers as $key => $vehicle_handover)
            <tr>
            <td>{{ $vehicle_handover->firstItem + $key + 1 }}</td>
            
<td>{{ $vehicle_handover->driver_id }}</td>
<td>{{ $vehicle_handover->vehicle_id }}</td>
<td>{{ $vehicle_handover->meter_upon_handover }}</td>
<td>{{ $vehicle_handover->authorization_start_date }}</td>
<td>{{ $vehicle_handover->authorization_end_date }}</td>
<td>{{ $vehicle_handover->front_right_image }}</td>
<td>{{ $vehicle_handover->back_left_image }}</td>
<td>{{ $vehicle_handover->created_at }}</td>
<td>{{ $vehicle_handover->updated_at }}</td>         <td>
           <a href="{{ route('vehicle_handovers.show', $vehicle_handover->id) }}"
                                                    class="btn btn-success mr-1 mb-1 btn-sm"><i
                                                        class="ti ti-eye"></i></a>
            <button value="{{  $vehicle_handover->id }}" class="btn btn-danger mr-1 mb-1 btn-sm "  onclick="showConfirmation(this)"   ><i class="ti ti-trash"></i></button>
                                                <form id="destroy-vehicle_handover_{{  $vehicle_handover->id }}"
                                                    action="{{ route('vehicle_handovers.destroy', $vehicle_handover->id) }}" method="POST"
                                                    style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
           </td>
        </tr>
 @endforeach
   </tbody>
        <tfoot>
       <tr><td      colspan="10"  >{{$vehicle_handovers->links("pagination::bootstrap-4")}} </td></tr>
        </tfoot>
</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   @stop
                  
