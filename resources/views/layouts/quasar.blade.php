@extends(request()->ajax() ? 'weikit::layouts.vue' : 'weikit::layouts.main')

@section('use_quasar', true)
@section('hide_content', true)

@section('after_content')
<template id="@yield('wrap_id', 'vue-template')">
    @yield('content')
</template>
@endsection
