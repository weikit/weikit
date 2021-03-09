@extends('weikit::layouts.main')

@section('use_tailwind', true)

@section('wrap_class', 'flex h-screen items-center justify-center p-4')

@section('content')
    <div class="w-full max-w-sm space-y-8">

        {{ $slot }}

    </div>
@endsection
