<section class="video-area pt-150 pb-150 p-relative"
         @if ($backgroundImage = $shortcode->background_image)
             style="background-image:url('{{ RvMedia::getImageUrl($backgroundImage) }}'); background-repeat: no-repeat; background-position: center bottom; background-size:cover;"
         @endif
    >

    <div class="content-lines-wrapper2">
        <div class="content-lines-inner2">
            <div class="content-lines2"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="s-video-wrap">
                    @if ($youtubeVideoId = $shortcode->youtube_video_id )
                        <div class="s-video-content">
                            <a href="https://www.youtube.com/watch?v={{ $youtubeVideoId }}" class="popup-video">
                                @php
                                    $buttonIcon = $shortcode->button_icon ?
                                            RvMedia::getImageUrl($shortcode->button_icon) :
                                            Theme::asset()->url('/images/play-button.png')
                                @endphp
                                <img src="{{ $buttonIcon }}" alt="{{ __('Button play') }}">
                            </a>
                        </div>
                    @endif
                </div>
                <div class="section-title center-align text-center">
                    @if($title = $shortcode->title)
                        <h2>{!! BaseHelper::clean($title) !!}</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
