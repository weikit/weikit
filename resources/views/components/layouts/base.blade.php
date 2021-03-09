@extends('weikit::layouts.main')

@section('use_tailwind', true)

@section('content')
    <div class="w-full max-w-sm space-y-8">

        {{ $slot }}

    </div>
@endsection
