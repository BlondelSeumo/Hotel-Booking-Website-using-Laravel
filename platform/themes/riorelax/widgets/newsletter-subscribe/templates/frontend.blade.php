@if (is_plugin_active('newsletter'))
    <div class="col-xl-4 col-lg-4 col-sm-6">
        <div class="footer-widget mb-30">
            @if ($title = $config['title'])
                <div class="f-widget-title">
                    <h2>{!! BaseHelper::clean($title) !!}</h2>
                </div>
            @endif

            <div class="footer-link" dir="ltr">
                <div class="subricbe p-relative form-newsletter" data-animation="fadeInDown" data-delay=".4s" >
                    {!! $form->renderForm() !!}
                </div>
            </div>

        </div>
    </div>
@endif
