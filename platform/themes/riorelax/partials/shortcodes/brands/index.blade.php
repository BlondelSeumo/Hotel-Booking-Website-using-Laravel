@php($bgColor = $shortcode->background_color ?: '#f7f5f1')

<div class="brand-area pt-60 pb-60" style="background-color: {{ $bgColor }}">
    <div class="container">
        <div class="row brand-active">
            @foreach($tabs as $tab)
                <div class="col-xl-2">
                    @if($tab['image'])
                        <div class="single-brand">
                            <a href="{{ $tab['link'] }}">
                                <img src="{{ RvMedia::getImageUrl($tab['image']) }}" alt="{{ $tab['name'] }}">
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
