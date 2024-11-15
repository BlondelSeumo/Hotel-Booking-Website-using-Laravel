@if (is_plugin_active('language'))
    @php
        $supportedLocales = Language::getSupportedLocales();

        if (empty($options)) {
            $options = [
                'before' => '',
                'lang_flag' => true,
                'lang_name' => true,
                'class' => '',
                'after' => '',
            ];
        }
    @endphp

    @if ($supportedLocales && count($supportedLocales) > 1)
        @php
            $languageDisplay = setting('language_display', 'all');
            $showRelated = setting('language_show_default_item_if_current_version_not_existed', true);
        @endphp

        @foreach ($supportedLocales as $localeCode => $properties)
            <li>
                <a @class(['language-item d-flex', 'active' => Language::getCurrentLocaleCode() === $localeCode]) href="{{ $showRelated ? Language::getLocalizedURL($localeCode) : url($localeCode) }}" target="_self">
                    @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                        {!! language_flag($properties['lang_flag']) !!} <span class="ms-1">{{ $properties['lang_name'] }}</span>
                    @endif
                    @if (Arr::get($options, 'lang_name', true) &&  ($languageDisplay == 'name'))
                        &nbsp;{{ $properties['lang_name'] }}
                    @endif
                </a>
            </li>
        @endforeach
    @endif
@endif

