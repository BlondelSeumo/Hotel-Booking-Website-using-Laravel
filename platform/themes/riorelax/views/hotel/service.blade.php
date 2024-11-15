@php(Theme::set('pageTitle', $service->name))

<section>
    <div class="about-area5 about-p p-relative">
        <div class="container pt-120 pb-90">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4 order-1">
                    <aside class="sidebar services-sidebar">
                        <div class="sidebar-widget categories">
                            @if ($services->isNotEmpty())
                                <div class="widget-content">
                                    <h2 class="widget-title"> {{ __('Services') }} </h2>
                                    <ul class="services-categories">
                                        @foreach($services as $serviceItem)
                                            <li @class(['active' => request()->url() === $serviceItem->url])><a href="{{ $serviceItem->url }}">{{ $serviceItem->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                       {!! dynamic_sidebar('service_sidebar') !!}
                    </aside>
                </div>

                <div class="col-lg-8 col-md-12 col-sm-12 order-2">
                    {!! BaseHelper::clean($service->content) !!}
                </div>
            </div>
        </div>
    </div>
</section>
