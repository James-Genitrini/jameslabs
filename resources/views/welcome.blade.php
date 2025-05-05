@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-center mb-6">Bienvenue sur mon blog !</h1>
    <p class="text-center mb-6">Découvrez mes derniers articles ci-dessous.</p>

    {{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"> --}}
        {{-- @foreach($posts as $post)
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                <p class="text-gray-600 mb-4">{{ Str::limit($post->content, 100) }}</p>
                <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:text-blue-800">Lire plus</a>
            </div>
        @endforeach --}}
    {{-- </div> --}}
@endsection