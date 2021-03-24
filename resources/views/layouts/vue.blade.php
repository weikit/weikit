@yield('before_content')
@sectionMissing('hide_content')
    @yield('content')
@endif
@yield('after_content')

@stack('script')

@stack('style')
