<!-- alerts -->
@if (request()->session()->exists('message') && request()->session()->exists('alert-primary'))
    <div class="alert alert-primary alert-dismissible" role="alert">
        {!! session('message') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif
@if (request()->session()->exists('message') && request()->session()->exists('alert-danger'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        {!! session('message') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif
@if (request()->session()->exists('message') && request()->session()->exists('alert-info'))
    <div class="alert alert-info alert-dismissible" role="alert">
        {!! session('message') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif
@if (request()->session()->exists('message') && request()->session()->exists('alert-success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {!! session('message') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif
@if (request()->session()->exists('message') &&
        request()->session()->exists('alert-success-link') &&
        request()->session()->exists('alert-link'))
    <div class="alert alert-success" role="alert">
        {!! session('message') !!}
        <a href="{{ session('alert-link') }}" class="alert-link">
            <i class="fa fa-eye" aria-hidden="true"></i> {{ __('view') }}
        </a>
    </div>
@endif
@if (request()->session()->exists('message') &&
        request()->session()->exists('alert-danger-link') &&
        request()->session()->exists('alert-link'))
    <div class="alert alert-danger" role="alert">
        {!! session('message') !!}
        <a href="{{ session('alert-link') }}" class="alert-link">
            <i class="fa fa-eye" aria-hidden="true"></i> {{ __('view') }}
        </a>
    </div>
@endif
