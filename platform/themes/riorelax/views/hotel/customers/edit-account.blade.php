@extends(HotelHelper::viewPath('customers.master'))

@section('content')
    @php
        $user = auth('customer')->user();
    @endphp

    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="text-center">{{ __('Edit Profile') }}</h1>
        </div>
        <div>
            {!! Form::open(['route' => 'customer.edit-account']) !!}
                <div class="row">
                    <div class="col-md">
                        <div class="form-group mb-20">
                            <label for="first_name" class="input-group-prepend mb-10 mt-20">{{ __('First Name') }}: </label>
                            <input id="first_name" type="text" class="form-control @if ($errors->has('first_name')) is-invalid @endif" name="first_name" value="{{ $user->first_name }}" />
                            {!! Form::error('first_name', $errors) !!}
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group mb-20">
                            <label for="last_name" class="input-group-prepend mb-10 mt-20">{{ __('Last Name') }}: </label>
                            <input id="last_name" type="text" class="form-control @if ($errors->has('last_name')) is-invalid @endif" name="last_name" value="{{ $user->last_name }}" />
                            {!! Form::error('last_name', $errors) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md">
                        <div class="form-group mb-20">
                            <label for="date_of_birth" class="input-group-prepend mb-10 mt-20">{{ __('Date of birth') }}: </label>
                            <input id="date_of_birth" type="text" class="form-control date-picker @if ($errors->has('dob')) is-invalid @endif" name="dob" value="{{ $user->dob }}" autocomplete="false"/>
                            {!! Form::error('dob', $errors) !!}
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group mb-20">
                            <label for="email" class="input-group-prepend mb-10 mt-20">{{ __('Email') }}: </label>
                            <input id="email" type="text" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" value="{{ $user->email }}" disabled />
                            {!! Form::error('email', $errors) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md">
                        <div class="form-group mb-20">
                            <label for="country" class="input-group-prepend mb-10 mt-20">{{ __('Country') }}: </label>
                            <input id="country" type="text" class="form-control @if ($errors->has('country')) is-invalid @endif" name="country" value="{{ $user->country }}" />
                            {!! Form::error('country', $errors) !!}
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group mb-20">
                            <label for="state" class="input-group-prepend mb-10 mt-20">{{ __('State / Province') }}: </label>
                            <input id="state" type="text" class="form-control @if ($errors->has('state')) is-invalid @endif" name="state" value="{{ $user->state }}" />
                            {!! Form::error('state', $errors) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md">
                        <div class="form-group mb-20">
                            <label for="city" class="input-group-prepend mb-10 mt-20">{{ __('City') }}: </label>
                            <input id="city" type="text" class="form-control @if ($errors->has('city')) is-invalid @endif" name="city" value="{{ $user->city }}" />
                            {!! Form::error('city', $errors) !!}
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group mb-20">
                            <label for="address" class="input-group-prepend mb-10 mt-20">{{ __('Address') }}: </label>
                            <input id="address" type="text" class="form-control @if ($errors->has('address')) is-invalid @endif" name="address" value="{{ $user->address }}" />
                            {!! Form::error('address', $errors) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md">
                        <div class="form-group mb-20">
                            <label for="zip" class="input-group-prepend mb-10 mt-20">{{ __('Postal / Zip code') }}: </label>
                            <input id="zip" type="text" class="form-control @if ($errors->has('zip')) is-invalid @endif" name="zip" value="{{ $user->zip }}" aria-describedby="txt-zip-error" />
                            {!! Form::error('zip', $errors) !!}
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group mb-20">
                            <label for="phone" class="input-group-prepend mb-10 mt-20">{{ __('Phone number') }}: </label>
                            <input id="phone" type="text" class="form-control @if ($errors->has('phone')) is-invalid @endif" name="phone" value="{{ $user->phone }}" />
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
