<div class="row">
    <div class="col-lg-12">
        <div class="skills-content s-about-content mt-20">
            <div class="skills">
                @foreach($tabs as $tab)
                    <div class="skill mb-30">
                        @if ($tab['title'])
                            <div class="skill-name">{!! BaseHelper::clean($tab['title']) !!}</div>
                        @endif
                        <div class="skill-bar">
                            <div class="skill-per" id="{{ $tab['percentage'] }}"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
<div class="two-column mt-30">
    <div class="row">
        @if ($image1 = $shortcode->image_1)
            <div class="image-column col-xl-6 col-lg-12 col-md-12">
                <figure class="image"><img src="{{ RvMedia::getImageUrl($image1) }}" alt="{{ __('Image') }}"></figure>
            </div>
        @endif

        @if ($image2 = $shortcode->image_2)
            <div class="text-column col-xl-6 col-lg-12 col-md-12">
                <figure class="image"><img src="{{ RvMedia::getImageUrl($image2) }}" alt="{{ __('Image') }}"></figure>
            </div>
        @endif
    </div>
</div>
