<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family={{ urlencode(theme_option('primary_font', 'Epilogue')) }}:400,500,600,700" rel="stylesheet" type="text/css">

    <style>
        :root {
            --primary-color: {{ theme_option('primary_color', '#fec201') }};
            --secondary-color: {{ theme_option('secondary_color', '#034460') }};
            --input-border-color: {{ theme_option('input_border_color', '#d7cfc8') }};
            --primary-color-hover: {{ theme_option('primary_color_hover', '#066a4c') }};
            --btn-text-color-hover: {{ theme_option('button_text_color_hover', '#101010') }};
            --heading-font: '{{ theme_option('heading_font', 'Jost') }}', sans-serif;
            --primary-font: '{{ theme_option('primary_font', 'Roboto') }}', sans-serif;
        }
    </style>
    {!! Theme::header() !!}
    {!! Theme::partial('preloader') !!}
</head>
<body @if (BaseHelper::isRtlEnabled()) dir="rtl" @endif>
{!! apply_filters(THEME_FRONT_BODY, null) !!}

@yield('main')

{!! Theme::footer() !!}
@if (session()->has('success_msg') || session()->has('error_msg') || (isset($errors) && $errors->count() > 0) || isset($error_msg))
    <script type="text/javascript">
        $(document).ready(function () {
            @if (session()->has('success_msg'))
                RiorelaxTheme.showSuccess('{{ session('success_msg') }}');
            @endif

            @if (session()->has('error_msg'))
                RiorelaxTheme.showError('{{ session('error_msg') }}');
            @endif

            @if (isset($error_msg))
                RiorelaxTheme.showError('{{ $error_msg }}');
            @endif

            @if (isset($errors))
                @foreach ($errors->all() as $error)
                    RiorelaxTheme.showError('{!! BaseHelper::clean($error) !!}');
                @endforeach
            @endif
        });
    </script>
@endif
</body>
</html>
