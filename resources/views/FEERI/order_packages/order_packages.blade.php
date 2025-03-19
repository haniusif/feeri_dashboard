@extends('layouts.layoutMaster')
@section('title', __('Order Packages') )
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
                    document.getElementById('destroy-order_package_'+id).submit();

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
            <li class="breadcrumb-item active">{{ __('Order Packages') }}
            </li>
        </ol>
    </div>
     @include('_partials.alerts')
     @include('FEERI.order_packages.search.search')
    <div class="col-12">
    <div class="card">
                    <div class="card-body">
                      <div class="card-title header-elements">
                        <h5 class="m-0 me-2">{{ __('Order Packages') }}</h5>
                        @can('create order_packages')
                        <div class="card-title-elements ms-auto">
                         <a  href="{{ route('order_packages.create') }}" class="btn btn-xs btn-primary waves-effect waves-light">
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

<th  >{{ __('order_packages_order_id') }}</th>
<th  >{{ __('order_packages_package_name') }}</th>
<th  >{{ __('order_packages_package_description') }}</th>
<th  >{{ __('order_packages_package_weight') }}</th>
<th  >{{ __('order_packages_package_length') }}</th>
<th  >{{ __('order_packages_package_width') }}</th>
<th  >{{ __('order_packages_package_height') }}</th>
<th  >{{ __('order_packages_package_weight_vol') }}</th>
<th  >{{ __('order_packages_created_at') }}</th>
<th  >{{ __('order_packages_updated_at') }}</th> <th >{{ __('Action') }}</th>
    </tr>
     </thead>
          <tbody>
          @foreach ($order_packages as $key => $order_package)
            <tr>
            <td>{{ $order_package->firstItem + $key + 1 }}</td>
            
<td>{{ $order_package->order_id }}</td>
<td>{{ $order_package->package_name }}</td>
<td>{{ $order_package->package_description }}</td>
<td>{{ $order_package->package_weight }}</td>
<td>{{ $order_package->package_length }}</td>
<td>{{ $order_package->package_width }}</td>
<td>{{ $order_package->package_height }}</td>
<td>{{ $order_package->package_weight_vol }}</td>
<td>{{ $order_package->created_at }}</td>
<td>{{ $order_package->updated_at }}</td>         <td>
           <a href="{{ route('order_packages.show', $order_package->id) }}"
                                                    class="btn btn-success mr-1 mb-1 btn-sm"><i
                                                        class="ti ti-eye"></i></a>
            <button value="{{  $order_package->id }}" class="btn btn-danger mr-1 mb-1 btn-sm "  onclick="showConfirmation(this)"   ><i class="ti ti-trash"></i></button>
                                                <form id="destroy-order_package_{{  $order_package->id }}"
                                                    action="{{ route('order_packages.destroy', $order_package->id) }}" method="POST"
                                                    style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
           </td>
        </tr>
 @endforeach
   </tbody>
        <tfoot>
       <tr><td      colspan="11"  >{{$order_packages->links("pagination::bootstrap-4")}} </td></tr>
        </tfoot>
</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   @stop
                    
