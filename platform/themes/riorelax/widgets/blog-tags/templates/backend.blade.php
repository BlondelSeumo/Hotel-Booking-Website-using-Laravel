<section style="max-height: 400px; overflow: auto">
    <div class="form-group">
        <label for="widget-name">{{ __('Title') }}</label>
        <input type="text" class="form-control" name="title" value="{{ Arr::get($config, 'title') }}">
    </div>

    <div class="form-group">
        <label for="limit">{{ __('Limit') }}</label>
        <input type="number" class="form-control" name="limit" value="{{ Arr::get($config, 'limit', 5) }}" placeholder="{{ __('Number tags to show, leave empty to show all') }}">
    </div>
</section>
