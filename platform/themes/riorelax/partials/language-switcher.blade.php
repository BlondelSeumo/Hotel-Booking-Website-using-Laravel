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
        @if (setting('language_switcher_display', 'dropdown') == 'dropdown')
            <div class="dropdown language-switcher d-inline-flex align-items-center">
                <a class="dropdown-toggle" type="button" id="language-switcher-dropdown" data-bs-toggle="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                        {!! language_flag(Language::getCurrentLocaleFlag()) !!}
                        <span class="ms-1">{{ Language::getCurrentLocaleName() }}</span>
                    @endif

                    @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'name'))
                        &nbsp;<span>{{ Language::getCurrentLocaleName() }}</span>
                    @endif
                </a>
                <div class="dropdown-menu language-switcher-list" aria-labelledby="language-switcher-dropdown">
                    @foreach ($supportedLocales as $localeCode => $properties)
                        @if ($localeCode != Language::getCurrentLocale())
                            <li>
                                <a class="language-item" href="{{ $showRelated ? Language::getLocalizedURL($localeCode) : url($localeCode) }}" target="_self">
                                    @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                                        {!! language_flag($properties['lang_flag']) !!} <span>{{ $properties['lang_name'] }}</span>
                                    @endif
                                    @if (Arr::get($options, 'lang_name', true) &&  ($languageDisplay == 'name'))
                                        &nbsp;{{ $properties['lang_name'] }}
                                    @endif
                                </a>
                            </li>
                        @endif
                    @endforeach
                </div>
            </div>
        @else
            <ul @class(['d-inline-flex align-items-center language-switcher', Arr::get($options, 'class')])>
                @foreach ($supportedLocales as $localeCode => $properties)
                    @if ($localeCode !== Language::getCurrentLocale())
                        <li class="ms-3">
                            <a href="{{ Language::getSwitcherUrl($localeCode, $properties['lang_code']) }}">
                                @if (Arr::get($options, 'lang_flag', true) && ($languageDisplay == 'all' || $languageDisplay == 'flag'))
                                    {!! language_flag($properties['lang_flag'], $properties['lang_name']) !!}
                                @endif
                                @if (Arr::get($options, 'lang_name', true) && ($languageDisplay == 'all' || $languageDisplay == 'name'))
                                    &nbsp;<span>{{ $properties['lang_name'] }}</span>
                                @endif
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif
    @endif
@endif
