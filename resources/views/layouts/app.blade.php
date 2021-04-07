<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'Weikit')">
    @yield('meta')

    <script type="text/javascript">
        window.G = {
            i18nOptions: {
                locale: '{{ config('app.locale', 'en') }}',
                fallbackLocale: '{{ config('app.fallback_locale', 'en') }}',
            }
        };
    </script>

    @stack('before_style')

    <link rel="stylesheet" href="{{ mix('css/common.css', 'backend') }}">
    <link rel="stylesheet" href="{{ mix('css/quasar.css', 'backend') }}">

    @stack('after_style')

</head>

<body class="body @yield('body_class')">
@yield('before_content')

@inertia

@yield('after_content')

@stack('before_script')

<script type="text/javascript" src="{{ mix('js/manifest.js', 'backend') }}"></script>
<script type="text/javascript" src="{{ mix('vendor/common.js', 'backend') }}"></script>
<script type="text/javascript" src="{{ mix('vendor/quasar.js', 'backend') }}"></script>
<script type="text/javascript" src="{{ mix('js/quasar.js', 'backend') }}"></script>

@stack('script')

@stack('after_script')
</body>
</html>
