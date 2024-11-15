@extends(HotelHelper::viewPath('customers.master'))

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="text-center">{{ __('Account information') }}</h1>
        </div>

        <div class="mt-30">
            <div class="row">
                <div class="col-md-6">
                    @if (auth('customer')->user()->name)
                        <p>
                            <strong>
                                {{ __('Name') }}
                            </strong>:
                            <i>{{ auth('customer')->user()->name }}</i>
                        </p>
                    @endif

                    @if (auth('customer')->user()->email)
                        <p>
                            <strong>
                                {{ __('Email') }}
                            </strong>:
                            <i>{{ auth('customer')->user()->email }}</i>
                        </p>
                    @endif

                    @if (auth('customer')->user()->country)
                        <p>
                            <strong>
                                {{ __('Country') }}
                            </strong>:
                            <i>{{ auth('customer')->user()->country }}</i>
                        </p>
                    @endif

                    @if (auth('customer')->user()->city)
                        <p>
                            <strong>
                                {{ __('City') }}
                            </strong>:
                            <i>{{ auth('customer')->user()->city }}</i>
                        </p>
                    @endif

                    @if (auth('customer')->user()->zip)
                        <p>
                            <strong>
                                {{ __('Postal / Zip code') }}
                            </strong>:
                            <i>{{ auth('customer')->user()->zip }}</i>
                        </p>
                    @endif
                </div>
                <div class="col-md-6">
                    @if (auth('customer')->user()->dob)
                        <p>
                            <strong>
                                {{ __('Date of birth') }}
                            </strong>:
                            <i>{{ auth('customer')->user()->dob }}</i>
                        </p>
                    @endif

                    @if (auth('customer')->user()->phone)
                        <p>
                            <strong>
                                {{ __('Phone') }}
                            </strong>:
                            <i>{{ auth('customer')->user()->phone }}</i>
                        </p>
                    @endif

                    @if (auth('customer')->user()->state)
                        <p>
                            <strong>
                                {{ __('State / Province') }}
                            </strong>:
                            <i>{{ auth('customer')->user()->state }}</i>
                        </p>
                    @endif

                    @if (auth('customer')->user()->address)
                        <p>
                            <strong>
                                {{ __('Address') }}
                            </strong>:
                            <i>{{ auth('customer')->user()->address }}</i>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
