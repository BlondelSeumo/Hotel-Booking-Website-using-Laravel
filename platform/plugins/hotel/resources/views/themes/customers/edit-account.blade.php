@extends(HotelHelper::viewPath('customers.master'))

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="text-center">{{ __('Edit Profile') }}</h1>
        </div>
        <div>
            {!! Form::open(['route' => 'customer.edit-account']) !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-20">
                        <label for="first_name" class="input-group-prepend mb-10 mt-20">{{ __('First Name') }}: </label>
                        <input id="first_name" type="text" class="form-control" name="first_name" value="{{ auth('customer')->user()->first_name }}" />
                        {!! Form::error('first_name', $errors) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-20">
                        <label for="last_name" class="input-group-prepend mb-10 mt-20">{{ __('Last Name') }}: </label>
                        <input id="last_name" type="text" class="form-control" name="last_name" value="{{ auth('customer')->user()->last_name }}" />
                        {!! Form::error('last_name', $errors) !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-20 @if ($errors->has('dob')) has-error @endif">
                        <label for="date_of_birth" class="input-group-prepend mb-10 mt-20">{{ __('Date of birth') }}: </label>
                        <input id="date_of_birth" type="text" class="form-control date-picker" name="dob" value="{{ auth('customer')->user()->dob }}" autocomplete="false"/>
                        {!! Form::error('dob', $errors) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-20 @if ($errors->has('email')) has-error @endif">
                        <label for="email" class="input-group-prepend mb-10 mt-20">{{ __('Email') }}: </label>
                        <input id="email" type="text" class="form-control" name="email" value="{{ auth('customer')->user()->email }}" disabled />
                        {!! Form::error('email', $errors) !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-20 @if ($errors->has('country')) has-error @endif">
                        <label for="country" class="input-group-prepend mb-10 mt-20">{{ __('Country') }}: </label>
                        <input id="country" type="text" class="form-control" name="country" value="{{ auth('customer')->user()->country }}" />
                        {!! Form::error('country', $errors) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-20 @if ($errors->has('state')) has-error @endif">
                        <label for="state" class="input-group-prepend mb-10 mt-20">{{ __('State / Province') }}: </label>
                        <input id="state" type="text" class="form-control" name="state" value="{{ auth('customer')->user()->state }}" />
                        {!! Form::error('state', $errors) !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-20 @if ($errors->has('city')) has-error @endif">
                        <label for="city" class="input-group-prepend mb-10 mt-20">{{ __('City') }}: </label>
                        <input id="city" type="text" class="form-control" name="city" value="{{ auth('customer')->user()->city }}" />
                        {!! Form::error('city', $errors) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-20 @if ($errors->has('address')) has-error @endif">
                        <label for="address" class="input-group-prepend mb-10 mt-20">{{ __('Address') }}: </label>
                        <input id="address" type="text" class="form-control" name="address" value="{{ auth('customer')->user()->address }}" />
                        {!! Form::error('address', $errors) !!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-20 @if ($errors->has('zip')) has-error @endif">
                        <label for="zip" class="input-group-prepend mb-10 mt-20">{{ __('Postal / Zip code') }}: </label>
                        <input id="zip" type="text" class="form-control" name="zip" value="{{ auth('customer')->user()->zip }}" aria-describedby="txt-zip-error" />
                        {!! Form::error('zip', $errors) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-20 @if ($errors->has('phone')) has-error @endif">
                        <label for="phone" class="input-group-prepend mb-10 mt-20">{{ __('Phone number') }}: </label>
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ auth('customer')->user()->phone }}" />
                        {!! Form::error('phone', $errors) !!}
                    </div>
                </div>
            </div>

            <div class="form-group col s12 mt-20">
                <button type="submit" class="btn btn-primary customer-btn">{{ __('Save Changes') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
