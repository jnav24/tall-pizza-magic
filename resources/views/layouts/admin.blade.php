@extends('layouts.base')

@section('body')
    <main class="bg-gray-100 h-screen w-screen">
        <livewire:admin.nav />

        <section class="flex justify-center">
            <div class="container pt-8">
                @yield('content')

                @isset($slot)
                    {{ $slot }}
                @endisset
            </div>
        </section>
    </main>
@endsection
