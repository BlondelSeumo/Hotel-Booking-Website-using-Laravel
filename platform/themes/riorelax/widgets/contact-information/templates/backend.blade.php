<section>
    <div class="form-group">
        <label class="control-label">{{ __('Phone number') }}</label>
        <textarea name="phone_number" class="form-control" placeholder="{{ __('Phone number') }}">{{ Arr::get($config, 'phone_number') }}</textarea>
    </div>

    <div class="form-group">
        <label class="control-label">{{ __('Email') }}</label>
        <textarea name="email" class="form-control" placeholder="{{ __('Enter email address') }}">{{ Arr::get($config, 'email') }}</textarea>
    </div>

    <div class="form-group">
        <label class="control-label">{{ __('Address') }}</label>
        <textarea name="address" class="form-control" placeholder="{{ __('Enter address') }}">{{ Arr::get($config, 'address') }}</textarea>
    </div>
</section>
