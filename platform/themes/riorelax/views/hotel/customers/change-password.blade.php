@extends(HotelHelper::viewPath('customers.master'))

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="customer-page-title text-center">{{ __('Change password') }}</h1>
        </div>
        <div class="panel-body custom-edit-account-form">
            {!! Form::open(['route' => 'customer.post.change-password', 'method' => 'post']) !!}

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-20">
                        <label for="old_password" class="input-group-prepend mb-10 mt-20">{{ __('Old Password') }}: </label>
                        <input id="old_password" type="password" class="form-control @if ($errors->has('old_password')) is-invalid @endif" name="old_password" placeholder="{{ __('Current Password') }}" />
                        {!! Form::error('old_password', $errors) !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-20">
                        <label for="password" class="input-group-prepend mb-10 mt-20">{{ __('New Password') }}: </label>
                        <input id="password" type="password" class="form-control @if ($errors->has('old_password')) is-invalid @endif" name="password" placeholder="{{ __('New Password') }}" />
                        {!! Form::error('password', $errors) !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mb-20">
                        <label for="password_confirmation" class="input-group-prepend mb-10 mt-20">{{ __('Password Confirmation') }}: </label>
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Password Confirmation') }}" />
                    </div>
                </div>
            </div>

            <div class="form-group col s12 mt-20">
                <button type="submit" class="btn btn-primary btn-sm">{{ __('Change password') }}</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop
