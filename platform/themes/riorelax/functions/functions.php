<?php

use Botble\ACL\Forms\ProfileForm;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\EditorFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\EditorField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Hotel\Forms\AmenityForm;
use Botble\Media\Facades\RvMedia;
use Botble\Page\Forms\PageForm;
use Botble\SimpleSlider\Forms\SimpleSliderItemForm;

register_page_template([
    'default' => __('Default'),
    'side-menu' => __('Side menu'),
    'full-menu' => __('Full menu'),
    'blog-sidebar' => __('Blog sidebar'),
    'full-width' => __('Full width'),
]);

register_sidebar([
    'id' => 'footer_sidebar',
    'name' => 'Footer sidebar',
    'description' => __('Area for footer widgets'),
]);

register_sidebar([
    'id' => 'blog_sidebar',
    'name' => __('Blog sidebar'),
    'description' => __('Sidebar on the right of the blog detail site.'),
]);

register_sidebar([
    'id' => 'room_sidebar',
    'name' => __('Room details sidebar'),
    'description' => __('Sidebar in the room page'),
]);

register_sidebar([
    'id' => 'rooms_sidebar',
    'name' => __('Rooms sidebar'),
    'description' => __('Sidebar in the rooms page'),
]);

register_sidebar([
    'id' => 'service_sidebar',
    'name' => __('Service sidebar'),
    'description' => __('Sidebar in the service page'),
]);

RvMedia::setUploadPathAndURLToPublic()
    ->addSize('medium', 440, 340)
    ->addSize('small', 300, 340)
    ->addSize('room-image', 850, 460);

if (class_exists(PageForm::class)) {
    PageForm::extend(function (PageForm $form) {
        $form
            ->addAfter(
                'template',
                'breadcrumb_background',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Breadcrumb background'))
                    ->metadata()
                    ->toArray()
            )
            ->addAfter(
                'template',
                'breadcrumb',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Breadcrumb'))
                    ->choices(['0' => __('No'), '1' => __('Yes')])
                    ->metadata()
                    ->toArray()
            );
    }, 99);
}

app()->booted(function () {
    if (is_plugin_active('simple-slider')) {
        SimpleSliderItemForm::extend(function (SimpleSliderItemForm $form) {
            $form
                ->addAfter(
                    'title',
                    'subtitle',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Subtitle'))
                        ->metadata()
                        ->placeholder(__('Enter the subtitle'))
                        ->toArray()
                )
                ->addAfter(
                    'subtitle',
                    'description',
                    TextareaField::class,
                    DescriptionFieldOption::make()
                        ->metadata()
                        ->toArray()
                )
                ->addAfter(
                    'subtitle',
                    'button_primary_url',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Button URL'))
                        ->placeholder(__('Enter the button URL'))
                        ->metadata()
                        ->toArray()
                )
                ->addAfter(
                    'subtitle',
                    'button_primary_label',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Button label'))
                        ->placeholder(__('Enter the button label'))
                        ->metadata()
                        ->toArray()
                )
                ->addAfter(
                    'subtitle',
                    'button_play_label',
                    TextField::class,
                    TextFieldOption::make()
                        ->label(__('Button play label'))
                        ->placeholder(__('Enter the button play label'))
                        ->metadata()
                        ->toArray()
                )
                ->addAfter(
                    'subtitle',
                    'youtube_url',
                    TextField::class,
                    TextFieldOption::make()
                        ->metadata()
                        ->placeholder(__('Enter the YouTube URL'))
                        ->label(__('YouTube URL'))
                        ->toArray()
                );
        }, 99);
    }

    if (is_plugin_active('hotel')) {
        AmenityForm::extend(function (AmenityForm $form) {
            $form
                ->addAfter(
                    'icon',
                    'icon_image',
                    MediaImageField::class,
                    MediaImageFieldOption::make()
                        ->metadata()
                        ->label(__('Icon Image (It will replace Font Icon if it is present)'))
                        ->toArray()
                )
                ->addAfter(
                    'name',
                    'description',
                    TextareaField::class,
                    DescriptionFieldOption::make()
                        ->metadata()
                        ->toArray()
                );
        }, 99);
    }

    ProfileForm::extend(function (ProfileForm $form) {
        $form->getModel()->loadMissing('metadata');

        $form
            ->addAfter('email', 'display_name', TextField::class, TextFieldOption::make()->label(__('Display name'))->metadata()->colspan(2)->toArray())
            ->addAfter('display_name', 'bio', EditorField::class, EditorFieldOption::make()->label(__('Bio'))->metadata()->colspan(2)->toArray())
            ->addAfter('bio', 'facebook', TextField::class, TextFieldOption::make()->label(__('Facebook'))->metadata()->placeholder('https://www.facebook.com')->toArray())
            ->addAfter('facebook', 'twitter', TextField::class, TextFieldOption::make()->label(__('X (Twitter)'))->metadata()->placeholder('https://x.com')->toArray())
            ->addAfter('twitter', 'instagram', TextField::class, TextFieldOption::make()->label(__('Instagram'))->metadata()->placeholder('https://www.instagram.com')->toArray())
            ->addAfter('instagram', 'behance', TextField::class, TextFieldOption::make()->label(__('Behance'))->metadata()->placeholder('https://www.behance.net')->toArray())
            ->addAfter('behance', 'linkedin', TextField::class, TextFieldOption::make()->label(__('Linkedin'))->metadata()->placeholder('https://www.linkedin.com')->toArray());
    });
});
