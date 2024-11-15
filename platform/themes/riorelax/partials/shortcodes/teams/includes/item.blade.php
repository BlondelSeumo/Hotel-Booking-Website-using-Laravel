<div class="single-team mb-40">
    <div class="team-thumb">
        <a href="{{ $team->url }}">
            <div class="brd">
                <img src="{{ RvMedia::getImageUrl($team->photo, 'small', false, RvMedia::getDefaultImage()) }}" alt="{{ $team->title }}" />
            </div>
        </a>
    </div>
    <div class="team-info">
        @if ($name = $team->name)
            <h4><a href="{{ $team->url }}">{{ $name }}</a></h4>
        @endif

        @if($title = $team->title)
            <p>{{ $title }}</p>
        @endif

        @if ($socials = $team->socials)
            <div class="team-social">
                <ul>
                    @foreach(['facebook', 'twitter', 'instagram'] as $social)
                        @if ($url = Arr::get($socials, $social))
                            @switch($social)
                                @case('twitter')
                                    <li>
                                        <a href="{{ $url }}">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    @break

                                @case('facebook')
                                    <li>
                                        <a href="{{ $url }}">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    @break

                                @case('instagram')
                                    <li>
                                        <a href="{{ $url }}">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    @break

                            @endswitch
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
