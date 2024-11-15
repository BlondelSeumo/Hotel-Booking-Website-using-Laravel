<section class="pb-2" style="max-height: 400px; overflow: auto">
    <div class="form-group">
        <label>{{ __('Title') }}</label>
        <input type="text" class="form-control" name="title" value="{{ Arr::get($config, 'title') }}">
    </div>
    @for($i = 1; $i < 10; $i++)
        <div class="border p-2 mb-2">
            <h6>{{ __("Social $i") }}</h6>
            <div class="mb-3">
                <label for="" class="form-label">{{ __("Link $i") }}</label>
                <input type="text" class="form-control" name="link_{{ $i }}" value="{{ Arr::get($config, "link_$i") }}">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">{{ __("Icon $i") }}</label>
                {!! Form::themeIcon("icon_$i", Arr::get($config, "icon_$i")) !!}
            </div>
        </div>
    @endfor
</section>
