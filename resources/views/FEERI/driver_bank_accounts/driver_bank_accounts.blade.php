@extends('layouts.layoutMaster')
@section('title', __('Driver Bank Accounts') )
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
                    document.getElementById('destroy-driver_bank_account_'+id).submit();

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
            <li class="breadcrumb-item active">{{ __('Driver Bank Accounts') }}
            </li>
        </ol>
    </div>
     @include('_partials.alerts')
     @include('FEERI.driver_bank_accounts.search.search')
    <div class="col-12">
    <div class="card">
                    <div class="card-body">
                      <div class="card-title header-elements">
                        <h5 class="m-0 me-2">{{ __('Driver Bank Accounts') }}</h5>
                        @can('create driver_bank_accounts')
                        <div class="card-title-elements ms-auto">
                         <a  href="{{ route('driver_bank_accounts.create') }}" class="btn btn-xs btn-primary waves-effect waves-light">
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

<th  >{{ __('driver_bank_accounts_driver_id') }}</th>
<th  >{{ __('driver_bank_accounts_bank_id') }}</th>
<th  >{{ __('driver_bank_accounts_account_number') }}</th>
<th  >{{ __('driver_bank_accounts_ipan') }}</th>
<th  >{{ __('driver_bank_accounts_is_default') }}</th>
<th  >{{ __('driver_bank_accounts_created_at') }}</th>
<th  >{{ __('driver_bank_accounts_updated_at') }}</th> <th >{{ __('Action') }}</th>
    </tr>
     </thead>
          <tbody>
          @foreach ($driver_bank_accounts as $key => $driver_bank_account)
            <tr>
            <td>{{ $driver_bank_account->firstItem + $key + 1 }}</td>
            
<td>{{ $driver_bank_account->driver_id }}</td>
<td>{{ $driver_bank_account->bank_id }}</td>
<td>{{ $driver_bank_account->account_number }}</td>
<td>{{ $driver_bank_account->ipan }}</td>
<td>
<span class="badge bg-label-{{ ($driver_bank_account->is_default == 1) ? __("success") : __("danger") }} ">
{{ ($driver_bank_account->is_default == 1) ? __("YES") : __("NO") }}
</span>
</td>
<td>{{ $driver_bank_account->created_at }}</td>
<td>{{ $driver_bank_account->updated_at }}</td>         <td>
           <a href="{{ route('driver_bank_accounts.show', $driver_bank_account->id) }}"
                                                    class="btn btn-success mr-1 mb-1 btn-sm"><i
                                                        class="ti ti-eye"></i></a>
            <button value="{{  $driver_bank_account->id }}" class="btn btn-danger mr-1 mb-1 btn-sm "  onclick="showConfirmation(this)"   ><i class="ti ti-trash"></i></button>
                                                <form id="destroy-driver_bank_account_{{  $driver_bank_account->id }}"
                                                    action="{{ route('driver_bank_accounts.destroy', $driver_bank_account->id) }}" method="POST"
                                                    style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
           </td>
        </tr>
 @endforeach
   </tbody>
        <tfoot>
       <tr><td      colspan="8"  >{{$driver_bank_accounts->links("pagination::bootstrap-4")}} </td></tr>
        </tfoot>
</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   @stop
              
