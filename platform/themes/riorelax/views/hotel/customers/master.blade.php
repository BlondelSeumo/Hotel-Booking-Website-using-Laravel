@php
    Theme::set('pageTitle',  "Profile");
@endphp

<div class="customer-page crop-avatar">
    <div class="container">
        <div class="customer-body">
            <div class="row body-border">
                <div class="col-md-3">
                    <div class="profile-sidebar">
                        <form id="avatar-upload-form" enctype="multipart/form-data" action="javascript:void(0)" onsubmit="return false">
                            <div class="avatar-upload-container">
                                <div class="form-group mb-3">
                                    <div id="account-avatar">
                                        <div class="profile-image custom-avatar-master">
                                            <div class="avatar-view mt-card-avatar">
                                                <img class="br2" src="{{ auth('customer')->user()->avatar_url }}" alt="{{ auth('customer')->user()->name }}" />
                                            </div>
                                            <i class="fa fa-pencil avatar-view"></i>
                                        </div>
                                    </div>
                                </div>
                                <div id="print-msg" class="text-danger hidden"></div>
                            </div>
                        </form>

                        <div class="text-center">
                            <div class="profile-usertitle-name">
                                <strong>{{ auth('customer')->user()->name }}</strong>
                            </div>
                        </div>

                        <div class="profile-usermenu">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <a href="{{ route('customer.overview') }}" class="d-inline-block w-100 collection-item @if (Route::currentRouteName() == 'customer.overview') active @endif">{{ __('Overview') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('customer.edit-account') }}" class="d-inline-block w-100 collection-item @if (Route::currentRouteName() == 'customer.edit-account') active @endif">{{ __('Profile') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('customer.change-password') }}" class="d-inline-block w-100 collection-item @if (Route::currentRouteName() == 'customer.change-password') active @endif">{{ __('Change password') }}</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('customer.bookings') }}" class="d-inline-block w-100 collection-item @if (Route::currentRouteName() == 'customer.bookings') active @endif">{{ __('My Bookings') }}</a>
                                </li>
                                @if (HotelHelper::isReviewEnabled())
                                    <li class="list-group-item">
                                        <a href="{{ route('customer.reviews') }}" class="d-inline-block w-100 collection-item @if (Route::currentRouteName() == 'customer.reviews') active @endif">{{ __('My Reviews') }}</a>
                                    </li>
                                @endif
                                <li class="list-group-item">
                                    <a href="{{ route('customer.logout') }}" class="d-inline-block w-100 collection-item">{{ __('Logout') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="profile-content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="avatar-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="avatar-form" method="post" action="{{ route('customer.avatar') }}" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="avatar-modal-label"><i class="til_img"></i><strong>{{ __('Profile Image') }}</strong></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">
                            <div class="avatar-upload">
                                <input class="avatar-src" name="avatar_src" type="hidden" />
                                <input class="avatar-data" name="avatar_data" type="hidden" />
                                @csrf
                                <label for="avatarInput">{{ __('New image') }}</label>
                                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file" />
                            </div>

                            <div class="loading" style="display: none;" tabindex="-1" role="img" aria-label="{{ __('Loading') }}"></div>

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                    <div class="error-message text-danger" style="display: none;"></div>
                                </div>
                                <div class="col-md-3 avatar-preview-wrapper">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button class="btn btn-primary avatar-save" type="submit">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
