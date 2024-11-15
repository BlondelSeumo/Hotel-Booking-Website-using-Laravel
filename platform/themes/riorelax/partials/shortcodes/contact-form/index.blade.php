<section id="contact" class="contact-area after-none contact-bg pt-90 pb-90 p-relative fix">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-4 order-1">
                <div class="contact-info">
                    @if($shortcode->address_label || $shortcode->address_detail)
                        <div class="single-cta pb-30 mb-30 wow fadeInUp animated" data-animation="fadeInDown animated" data-delay=".2s">
                            @if($addressIcon = $shortcode->address_icon)
                                <div class="float-start f-cta-icon">
                                    <i class="{{ $addressIcon }}"></i>
                                </div>
                            @endif

                            @if($addressLabel = $shortcode->address_label)
                                <h5>{{ $addressLabel }}</h5>
                            @endif

                            @if($addressDetail = $shortcode->address_detail)
                                <p>
                                    {!! BaseHelper::clean($addressDetail) !!}
                                </p>
                            @endif
                        </div>
                    @endif

                    @if($shortcode->work_time_label || $shortcode->work_time_detail)
                        <div class="single-cta pb-30 mb-30 wow fadeInUp animated" data-animation="fadeInDown animated" data-delay=".2s">
                            @if($workTimeIcon = $shortcode->work_time_icon)
                                <div class="float-start f-cta-icon">
                                    <i class="{{ $workTimeIcon }}"></i>
                                </div>
                            @endif

                            @if($workTimeLabel = $shortcode->work_time_label)
                                <h5>{{ $workTimeLabel }}</h5>
                            @endif

                            @if($workTimeDetail = $shortcode->work_time_detail)
                                <p>
                                    {!! BaseHelper::clean($workTimeDetail) !!}
                                </p>
                            @endif
                        </div>
                    @endif

                    @if($shortcode->phone_label && $shortcode->phone_detail)
                        <div class="single-cta pb-30 mb-30 wow fadeInUp animated" data-animation="fadeInDown animated" data-delay=".2s">
                            @if($phoneIcon = $shortcode->phone_icon)
                                <div class="float-start f-cta-icon">
                                    <i class="{{ $phoneIcon }}"></i>
                                </div>
                            @endif

                            @if($phoneLabel = $shortcode->phone_label)
                                <h5>{{ $phoneLabel }}</h5>
                            @endif

                            @if($phoneDetail = $shortcode->phone_detail)
                                <p>
                                    {!! BaseHelper::clean($phoneDetail) !!}
                                </p>
                            @endif
                        </div>
                    @endif

                    @if($shortcode->email_label || $shortcode->email_detail)
                        <div class="single-cta wow fadeInUp animated" data-animation="fadeInDown animated" data-delay=".2s">
                            @if($emailIcon = $shortcode->email_icon)
                                <div class="float-start f-cta-icon">
                                    <i class="{{ $emailIcon }}"></i>
                                </div>
                            @endif

                            @if($emailLabel = $shortcode->email_label)
                                <h5>{{ $emailLabel }}</h5>
                            @endif

                            @if($emailDetail = $shortcode->email_detail)
                                <p>
                                    {!! BaseHelper::clean($emailDetail) !!}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-8 order-2">
                <div class="contact-bg02">
                    @if($title = $shortcode->title)
                        <div class="section-title center-align mb-40 text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                            <h2>
                                {!! BaseHelper::clean($title) !!}
                            </h2>
                        </div>
                    @endif
                    {!! $form->renderForm() !!}
                </div>
            </div>
        </div>
    </div>
</section>
