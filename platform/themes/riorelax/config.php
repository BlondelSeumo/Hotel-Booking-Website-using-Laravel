<?php

use Botble\Base\Facades\BaseHelper;
use Botble\Shortcode\View\View;
use Botble\Theme\Theme;

return [

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists,
    | this is work with "layouts", "partials" and "views"
    |
    | [Notice] assets cannot inherit.
    |
    */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities
    | this is cool feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these events can be overridden by package config.
    |
    */

    'events' => [

        // Before event inherit from package config and the theme that call before,
        // you can use this event to set meta, breadcrumb template or anything
        // you want inheriting.
        'before' => function ($theme) {
            // You can remove this line anytime.
        },

        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme' => function (Theme $theme) {
            if (BaseHelper::isRtlEnabled()) {
                $theme->asset()->usePath()->add('bootstrap-css', 'plugins/bootstrap/bootstrap.rtl.min.css');
            } else {
                $theme->asset()->usePath()->add('bootstrap-css', 'plugins/bootstrap/bootstrap.min.css');
            }

            $theme->asset()->usePath()->add('animate-css', 'plugins/animate.min.css');
            $theme->asset()->usePath()->add('fontawesome-css', 'plugins/fontawesome-all.min.css');
            $theme->asset()->usePath()->add('slick-css', 'plugins/slick/slick.css');
            $theme->asset()->usePath()->add('magnific-popup-css', 'plugins/magnific-popup/magnific-popup.css');
            $theme->asset()->usePath()->add('toastr-css', 'plugins/toastr/toastr.min.css');
            $theme->asset()->usePath()->add('style-css', 'css/theme.css');
            $theme->asset()->usePath()->add('default-css', 'plugins/default.css');
            $theme->asset()->usePath()->add('responsive-css', 'plugins/responsive.css');
            $theme->asset()->usePath()->add('datepicker-css', 'plugins/datepicker/bootstrap-datepicker.css');

            $theme->asset()->container('header')->usePath()->add('jquery', 'plugins/jquery.min.js');
            $theme->asset()->container('footer')->usePath()->add('imagesloaded', 'plugins/imagesloaded.min.js');
            $theme->asset()->container('footer')->usePath()->add('counterup', 'plugins/jquery.counterup.min.js');
            $theme->asset()->container('footer')->usePath()->add('scrollUp', 'plugins/jquery.scrollUp.min.js');
            $theme->asset()->container('footer')->usePath()->add('waypoints', 'plugins/jquery.waypoints.min.js');
            $theme->asset()->container('footer')->usePath()->add('isotope-js', 'plugins/js_isotope.pkgd.min.js');
            $theme->asset()->container('footer')->usePath()->add('one-page-nav', 'plugins/one-page-nav-min.js');
            $theme->asset()->container('footer')->usePath()->add('parallax', 'plugins/parallax.min.js');
            $theme->asset()->container('footer')->usePath()->add('popper', 'plugins/popper.min.js');
            $theme->asset()->container('footer')->usePath()->add('slick-js', 'plugins/slick/slick.min.js');
            $theme->asset()->container('footer')->usePath()->add('wow-js', 'plugins/wow.min.js');
            $theme->asset()->container('footer')->usePath()->add('magnific-popup-js', 'plugins/magnific-popup/jquery.magnific-popup.min.js');
            $theme->asset()->container('footer')->usePath()->add('bootstrap-bundle-js', 'plugins/bootstrap/bootstrap.bundle.min.js');
            $theme->asset()->container('footer')->usePath()->add('datepicker-js', 'plugins/datepicker/bootstrap-datepicker.js');
            $theme->asset()->container('footer')->usePath()->add('toastr-js', 'plugins/toastr/toastr.min.js');
            $theme->asset()->container('footer')->usePath()->add('main', 'js/main.js');
            $theme->asset()->container('footer')->usePath()->add('script', 'js/script.js', ['datepicker-js', 'bootstrap-datepicker-locale']);

            if (function_exists('shortcode')) {
                $theme->composer(['page', 'post', 'teams.team', 'hotel.room', 'hotel.service'], function (View $view) {
                    $view->withShortcodes();
                });
            }
        },

        // Listen on event before render a layout,
        // this should call to assign style, script for a layout.
        'beforeRenderLayout' => [

            'default' => function ($theme) {
                // $theme->asset()->usePath()->add('ipad', 'css/layouts/ipad.css');
            },
        ],
    ],
];
