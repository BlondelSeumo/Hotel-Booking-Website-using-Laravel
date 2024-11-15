@php
    $breadcrumbBackgroundImage = Theme::get('breadcrumbBackgroundImage') ?: theme_option('breadcrumb_background_image');
    $bgImage = $breadcrumbBackgroundImage ? RvMedia::getImageUrl($breadcrumbBackgroundImage) : Theme::asset()->url('images/breadcrumb-bg.jpg');
@endphp

<section class="breadcrumb-area d-flex align-items-center" style="background-image:url({{ $bgImage }});">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-center">
                    <div class="breadcrumb-title">
                        @if($pageTitle = Theme::get('pageTitle'))
                            <h2>{!! BaseHelper::clean($pageTitle) !!}</h2>
                        @endif

                        @if($crumbs = Theme::breadcrumb()->getCrumbs())
                                <div class="breadcrumb-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            @foreach ($crumbs as $crumb)
                                                @if (! $loop->last)
                                                    <li class="breadcrumb-item"><a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a></li>
                                                @else
                                                    <li class="breadcrumb-item active" aria-current="page">{{ $crumb['label'] }}</li>
                                                @endif
                                            @endforeach
                                        </ol>
                                    </nav>
                                </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
