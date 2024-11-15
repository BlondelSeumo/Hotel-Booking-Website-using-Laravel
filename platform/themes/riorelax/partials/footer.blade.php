<footer class="footer-bg footer-p">
    <div class="footer-top  pt-90 pb-40"
         @if ($background = theme_option('background_footer'))
             style="background-image: url('{{ RvMedia::getImageUrl($background) }}');"
         @endif
    >
        <div class="container">
            <div class="row justify-content-between">
                {!! dynamic_sidebar('footer_sidebar') !!}
            </div>
        </div>
    </div>
    <div class="copyright-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    {{ theme_option('copyright') }}
                </div>
                <div class="col-lg-6 col-md-6 text-end text-xl-right">
                    @if ($socialLinks = json_decode(theme_option('social_links')))
                        <div class="footer-social">
                            @foreach($socialLinks as $social)
                                @php($social = collect($social)->pluck('value', 'key'))
                                <a target="_blank" href="{{ $social->get('url') }}" title="{{ $social->get('name') }}"><i class="{{ $social->get('social-icon') }}"></i></a>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</footer>
