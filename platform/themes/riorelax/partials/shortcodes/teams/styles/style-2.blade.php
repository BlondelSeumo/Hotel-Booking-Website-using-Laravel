<section class="team-area fix p-relative pt-90 pb-90" >
    <div class="container">
        <div class="row">
            @foreach($teams as $team)
                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                    {!! Theme::partial('shortcodes.teams.includes.item', compact('team')) !!}
                </div>
            @endforeach
        </div>
    </div>
</section>
