@extends('weikit::layouts.main')

@section('use_tailwind', true)

@section('body_class', 'bg-gray-100')

@section('wrap_class', 'flex h-screen items-center justify-center p-4')

@section('content')

    <div class="w-full max-w-7xl space-y-8">{{ $slot }}</div>

@endsection
