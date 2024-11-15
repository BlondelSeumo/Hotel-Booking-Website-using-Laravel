@php
    Theme::set('pageTitle', $place->name);

    $places = \Botble\Hotel\Models\Place::query()
            ->wherePublished()
            ->limit(20)
            ->get()
@endphp
<section>
    <div class="about-area5 about-p p-relative">
        <div class="container pt-120 pb-90">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4 order-1">
                    <aside class="sidebar services-sidebar">
                        <div class="sidebar-widget categories">
                            @if ($places->isNotEmpty())
                                <div class="widget-content">
                                    <h2 class="widget-title"> {{ __('Places') }} </h2>
                                    <ul class="services-categories">
                                        @foreach($places as $place)
                                            <li @class(['active' => request()->url() === $place->url])><a href="{{ $place->url }}">{{ $place->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        {!! dynamic_sidebar('service_sidebar') !!}
                    </aside>
                </div>

                <div class="col-lg-8 col-md-12 col-sm-12 order-2">
                    <div class="ck-content">{!! BaseHelper::clean($place->content) !!}</div>
                </div>
            </div>
        </div>
    </div>
</section>
