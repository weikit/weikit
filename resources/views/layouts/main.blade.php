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

    @stack('style')

    @hasSection('use_bootstrap')
        <link rel="stylesheet" href="{{ mix('css/bootstrap.css', 'backend') }}">
    @endif

    @hasSection('use_layui')
        <link rel="stylesheet" href="{{ mix('css/layui.css', 'backend') }}">
    @endif

    @hasSection('use_vuetify')
        <link rel="stylesheet" href="{{ mix('css/vuetify.css', 'backend') }}">
    @endif

    @hasSection('use_quasar')
        <link rel="stylesheet" href="{{ mix('css/quasar.css', 'backend') }}">
    @endif

    @stack('after_style')

</head>

<body class="body @yield('body_class')">
    @yield('before_content')

    <main id="@yield('wrap_id', 'app')" class="content @yield('wrap_class')">
        @sectionMissing('hide_content')
            @yield('content')
        @endif
    </main>

    @yield('after_content')

    @stack('before_script')

    <script type="text/javascript" src="{{ mix('js/manifest.js', 'backend') }}"></script>
    <script type="text/javascript" src="{{ mix('vendor/common.js', 'backend') }}"></script>
    <script type="text/javascript" src="{{ mix('common/browser.js', 'backend') }}"></script>

    @stack('script')

    @hasSection('use_bootstrap')
        <script type="text/javascript" src="{{ mix('vendor/bootstrap.js', 'backend') }}"></script>
        <script type="text/javascript" src="{{ mix('js/bootstrap.js', 'backend') }}"></script>
    @endif

    @hasSection('use_layui')
        <script type="text/javascript" src="{{ mix('js/layui.js', 'backend') }}"></script>
    @endif

    @hasSection('use_vuetify')
        <script type="text/javascript" src="{{ mix('vendor/vuetify.js', 'backend') }}"></script>
        <script type="text/javascript" type="module" src="{{ mix('js/vuetify.js', 'backend') }}"></script>
    @endif

    @hasSection('use_quasar')
        <script type="text/javascript" src="{{ mix('vendor/quasar.js', 'backend') }}"></script>
        <script type="text/javascript" src="{{ mix('js/quasar.js', 'backend') }}"></script>
    @endif

    @stack('after_script')
</body>
</html>
