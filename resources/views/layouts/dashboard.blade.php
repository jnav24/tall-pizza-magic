@extends('layouts.base')

@section('body')
    <main class="bg-gray-100 h-screen w-screen">
        @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
    </main>
@endsection
