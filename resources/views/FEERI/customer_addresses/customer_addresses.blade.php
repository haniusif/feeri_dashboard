@extends('layouts.layoutMaster')
@section('title', __('Customer Addresses') )
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
                    document.getElementById('destroy-customer_address_'+id).submit();

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
            <li class="breadcrumb-item active">{{ __('Customer Addresses') }}
            </li>
        </ol>
    </div>
     @include('_partials.alerts')
     @include('FEERI.customer_addresses.search.search')
    <div class="col-12">
    <div class="card">
                    <div class="card-body">
                      <div class="card-title header-elements">
                        <h5 class="m-0 me-2">{{ __('Customer Addresses') }}</h5>
                        @can('create customer_addresses')
                        <div class="card-title-elements ms-auto">
                         <a  href="{{ route('customer_addresses.create') }}" class="btn btn-xs btn-primary waves-effect waves-light">
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

<th  >{{ __('customer_addresses_user_id') }}</th>
<th  >{{ __('customer_addresses_country_id') }}</th>
<th  >{{ __('customer_addresses_city_id') }}</th>
<th  >{{ __('customer_addresses_neighbourhood_id') }}</th>
<th  >{{ __('customer_addresses_location_lat') }}</th>
<th  >{{ __('customer_addresses_location_lanf') }}</th>
<th  >{{ __('customer_addresses_zip_code') }}</th>
<th  >{{ __('customer_addresses_address') }}</th>
<th  >{{ __('customer_addresses_is_default') }}</th>
<th  >{{ __('customer_addresses_created_at') }}</th>
<th  >{{ __('customer_addresses_updated_at') }}</th> <th >{{ __('Action') }}</th>
    </tr>
     </thead>
          <tbody>
          @foreach ($customer_addresses as $key => $customer_address)
            <tr>
            <td>{{ $customer_address->firstItem + $key + 1 }}</td>
            
<td>{{ $customer_address->user_id }}</td>
<td>{{ $customer_address->country_id }}</td>
<td>{{ $customer_address->city_id }}</td>
<td>{{ $customer_address->neighbourhood_id }}</td>
<td>{{ $customer_address->location_lat }}</td>
<td>{{ $customer_address->location_lanf }}</td>
<td>{{ $customer_address->zip_code }}</td>
<td>{{ $customer_address->address }}</td>
<td>
<span class="badge bg-label-{{ ($customer_address->is_default == 1) ? __("success") : __("danger") }} ">
{{ ($customer_address->is_default == 1) ? __("YES") : __("NO") }}
</span>
</td>
<td>{{ $customer_address->created_at }}</td>
<td>{{ $customer_address->updated_at }}</td>         <td>
           <a href="{{ route('customer_addresses.show', $customer_address->id) }}"
                                                    class="btn btn-success mr-1 mb-1 btn-sm"><i
                                                        class="ti ti-eye"></i></a>
            <button value="{{  $customer_address->id }}" class="btn btn-danger mr-1 mb-1 btn-sm "  onclick="showConfirmation(this)"   ><i class="ti ti-trash"></i></button>
                                                <form id="destroy-customer_address_{{  $customer_address->id }}"
                                                    action="{{ route('customer_addresses.destroy', $customer_address->id) }}" method="POST"
                                                    style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
           </td>
        </tr>
 @endforeach
   </tbody>
        <tfoot>
       <tr><td      colspan="12"  >{{$customer_addresses->links("pagination::bootstrap-4")}} </td></tr>
        </tfoot>
</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   @stop
                      
