<section style="max-height: 400px; overflow: auto">
    <div class="form-group">
        <label>{{ __('Title') }}</label>
        <input type="text" class="form-control" name="title" value="{{ Arr::get($config, 'title') }}">
    </div>

    <div class="form-group">
        <label for="number_display">{{ __('Type') }}</label>
        {!! Form::customSelect('type', ['popular' => __('Popular Posts'), 'recent' => __('Recent Posts')], Arr::get($config, 'type')) !!}
    </div>

    <div class="form-group">
        <label for="description">{{ __('Description') }}</label>
        <textarea name="description" id="description" class="form-control">{{ Arr::get($config, 'description') }}</textarea>
    </div>

    <div class="form-group">
        <label>{{ __('Number posts to display') }}</label>
        <input type="text" class="form-control" name="limit" value="{{ Arr::get($config, 'limit') }}">
    </div>
</section>
