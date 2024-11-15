<?php

namespace Botble\Hotel\Http\Controllers\Front\Customers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Hotel\Facades\HotelHelper;
use Botble\Hotel\Http\Requests\AvatarRequest;
use Botble\Hotel\Http\Requests\EditAccountRequest;
use Botble\Hotel\Http\Requests\UpdatePasswordRequest;
use Botble\Media\Facades\RvMedia;
use Botble\Media\Services\ThumbnailService;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class PublicController extends BaseController
{
    public function __construct()
    {
        Theme::asset()
            ->add('customer-style', 'vendor/core/plugins/hotel/css/customer.css');

        Theme::asset()
            ->container('footer')
            ->add('utilities-js', 'vendor/core/plugins/hotel/js/utilities.js', ['jquery'])
            ->add('cropper-js', 'vendor/core/core/base/libraries/cropper.min.js', ['jquery'])
            ->add('avatar-js', 'vendor/core/plugins/hotel/js/avatar.js', ['jquery']);

        if (HotelHelper::loadCountriesStatesCitiesFromPluginLocation()) {
            Theme::asset()
                ->container('footer')
                ->add('location-js', 'vendor/core/plugins/location/js/location.js', ['jquery']);
        }
    }

    public function getOverview()
    {
        Theme::asset()
            ->container('footer')
            ->add('avatar-js', 'vendor/core/plugins/hotel/js/avatar.js', ['jquery']);

        SeoHelper::setTitle(__('Account information'));

        Theme::breadcrumb()
            ->add(__('Account information'), route('customer.overview'));

        return Theme::scope('hotel.customers.overview', [], 'plugins/hotel::themes.customers.overview')
            ->render();
    }

    public function getEditAccount()
    {
        SeoHelper::setTitle(__('Profile'));

        Theme::breadcrumb()
            ->add(__('Profile'), route('customer.edit-account'));

        return Theme::scope('hotel.customers.edit-account', [], 'plugins/hotel::themes.customers.edit-account')
            ->render();
    }

    public function postEditAccount(EditAccountRequest $request, BaseHttpResponse $response)
    {
        $customer = auth('customer')->user();

        $customer->fill($request->except('email'));

        $customer->dob = Carbon::parse($request->input('dob'))->toDateString();

        $customer->save();

        do_action(HANDLE_CUSTOMER_UPDATED_HOTEL, $customer, $request);

        return $response
            ->setNextUrl(route('customer.edit-account'))
            ->setMessage(__('Update profile successfully!'));
    }

    public function getChangePassword()
    {
        SeoHelper::setTitle(__('Change Password'));

        Theme::breadcrumb()
            ->add(__('Change Password'), route('customer.change-password'));

        return Theme::scope(
            'hotel.customers.change-password',
            [],
            'plugins/hotel::themes.customers.change-password'
        )->render();
    }

    public function postChangePassword(UpdatePasswordRequest $request, BaseHttpResponse $response)
    {
        $currentUser = auth('customer')->user();

        $currentUser->update([
            'password' => Hash::make($request->input('password')),
        ]);

        return $response->setMessage(__('Updated password successfully!'));
    }

    public function postAvatar(AvatarRequest $request, ThumbnailService $thumbnailService, BaseHttpResponse $response)
    {
        try {
            $account = auth('customer')->user();

            $result = RvMedia::handleUpload($request->file('avatar_file'), 0, $account->upload_folder);

            if ($result['error']) {
                return $response->setError()->setMessage($result['message']);
            }

            $avatarData = json_decode($request->input('avatar_data'));

            $file = $result['data'];

            $thumbnailService
                ->setImage(RvMedia::getRealPath($file->url))
                ->setSize((int) $avatarData->width, (int) $avatarData->height)
                ->setCoordinates((int) $avatarData->x, (int) $avatarData->y)
                ->setDestinationPath(File::dirname($file->url))
                ->setFileName(File::name($file->url) . 'Front' . File::extension($file->url))
                ->save('crop');

            $account->avatar = $file->url;
            $account->save();

            return $response
                ->setMessage(trans('plugins/customer::dashboard.update_avatar_success'))
                ->setData(['url' => RvMedia::url($file->url)]);
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }
}
