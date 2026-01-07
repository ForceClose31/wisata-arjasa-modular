@extends('layouts.customer')

@section('content')
    <section class="h-screen flex items-center justify-center bg-gradient-to-br from-teal-600 to-indigo-700">
        <div class="text-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 animate-pulse">{{ __('user.Segera hadir') }}</h1>
            <p class="text-lg md:text-2xl text-gray-100">{{ __('user.Halaman ini sedang dalam pengembangan. Nantikan informasi penginapan terbaik dari kami!') }}</p>
        </div>
    </section>
@endsection
