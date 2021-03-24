<template>
    @yield('before_content')

    @hasSection('wrap_content')
        @yield('wrap_content')
    @endif

    @sectionMissing('wrap_content')
        @yield('content')
    @endif

    @yield('after_content')
</template>

@stack('before_script')
@stack('script')
@stack('after_script')

@stack('before_style')
@stack('style')
@stack('after_style')
