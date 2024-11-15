<section class="team-area2 fix p-relative pt-105 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-relative">
                <div class="section-title center-align mb-40 text-center wow fadeInDown animated" data-animation="fadeInDown" data-delay=".4s">
                    @if($subtitle = $shortcode->subtittle)
                        <h5>{{ $subtitle }}</h5>
                    @endif

                    @if($title = $shortcode->title)
                        <h2>{!! BaseHelper::clean($title) !!}</h2>
                    @endif

                    @if($description = $shortcode->description)
                        <p>{!! BaseHelper::clean($description) !!}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="row team-active">
            @foreach($teams as $team)
                <div class="col-xl-4 col-md-6">
                   {!! Theme::partial('shortcodes.teams.includes.item', compact('team')) !!}
                </div>
            @endforeach
        </div>
    </div>
</section>
