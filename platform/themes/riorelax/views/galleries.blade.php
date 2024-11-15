@php
    Theme::asset()->container('footer')->usePath()->add('imagesloaded', 'plugins/imagesloaded.min.js', ['jquery']);
    Theme::layout('full-width');
    Theme::set('pageTitle', 'Galleries');
    Theme::set('breadcrumb', true);
@endphp

<section class="section pb-100">
    <section class="profile fix pt-60">
        <div class="container-xxl">
            {!! Theme::partial('gallery.galleries', ['galleries' => $galleries]) !!}
        </div>
    </section>
</section>
