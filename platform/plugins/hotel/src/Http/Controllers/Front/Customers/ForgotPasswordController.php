<?php

namespace Botble\Hotel\Http\Controllers\Front\Customers;

use Botble\ACL\Traits\SendsPasswordResetEmails;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Hotel\Forms\Fronts\Auth\ForgotPasswordForm;
use Botble\Hotel\Http\Requests\Fronts\Auth\ForgotPasswordRequest;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends BaseController
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('customer.guest');

        ResetPassword::createUrlUsing(function (CanResetPassword $target, string $token) {
            return url(route('customer.password.reset', [
                'token' => $token,
                'email' => $target->getEmailForPasswordReset(),
            ], false));
        });
    }

    public function showLinkRequestForm()
    {
        SeoHelper::setTitle(__('Forgot Password'));

        Theme::breadcrumb()
            ->add(__('Forgot Password'), route('customer.password.request'));

        return Theme::scope(
            'hotel.customers.passwords.email',
            ['form' => ForgotPasswordForm::create()],
            'plugins/hotel::themes.customers.passwords.email'
        )->render();
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    public function broker(): PasswordBroker
    {
        return Password::broker('customers');
    }
}
