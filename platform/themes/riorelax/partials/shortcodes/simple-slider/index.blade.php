<section id="home" class="slider-area fix p-relative">
    <div class="slider-active" style="background: #101010;">
        @foreach($sliders as $slider)
            <div class="single-slider slider-bg d-flex align-items-center" style="background-image:url({{ RvMedia::getImageUrl($slider->image) }}); background-size: cover;">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-7 col-md-7">
                            <div class="slider-content s-slider-content mt-80 text-center">
                                @if ($title = $slider->title)
                                    <h2 data-animation="fadeInUp" data-delay=".4s">{!! BaseHelper::clean($title) !!}</h2>
                                @endif

                                @if ($description = $slider->description)
                                    <p data-animation="fadeInUp" data-delay=".6s">{!! BaseHelper::clean($description) !!}</p>
                                @endif

                                <div class="slider-btn mt-30 mb-105">
                                    @php
                                        $buttonPrimaryLabel = $slider->getMetaData('button_primary_label', true);
                                        $buttonPrimaryUrl = $slider->getMetaData('button_primary_url', true);
                                        $buttonPlayLabel = $slider->getMetaData('button_play_label', true);
                                        $linkYoutubeUrl = $slider->getMetaData('youtube_url', true);

                                        if ($linkYoutubeUrl) {
                                            $linkYoutubeUrl = Botble\Theme\Supports\Youtube::getYoutubeVideoID($linkYoutubeUrl);
                                        }

                                    @endphp

                                    @if ($buttonPrimaryUrl && $buttonPrimaryLabel)
                                        <a href="{{ $buttonPrimaryUrl }}" class="btn ss-btn active mr-15" data-animation="fadeInLeft" data-delay=".4s">
                                            {!! BaseHelper::clean($buttonPrimaryLabel) !!}
                                        </a>
                                    @endif

                                    @if ($buttonPlayLabel && $linkYoutubeUrl)
                                        <a href="https://www.youtube.com/watch?v={{ $linkYoutubeUrl }}" class="video-i popup-video" data-animation="fadeInUp" data-delay=".8s" style="animation-delay: 0.8s;" tabindex="0">
                                            <i class="fas fa-play"></i>
                                            {!! BaseHelper::clean($buttonPlayLabel) !!}
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
