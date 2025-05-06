@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-center mb-6">Bienvenue sur JamesLabs !</h1>
    <p class="text-center mb-6">Découvrez mes derniers articles ci-dessous.</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $post)
            <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 p-6 rounded-lg shadow-md flex flex-col h-full">
                <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                @if($post->hasMedia('thumbnail'))
                    <div class="w-full h-48 bg-gray-200 overflow-hidden rounded-lg mb-4">
                        <img src="{{ $post->getFirstMediaUrl('thumbnail', 'preview') }}" alt="{{ $post->title }}" class="object-cover w-full h-full">
                    </div>
                @endif
                <p class="text-gray-600 dark:text-gray-300 mb-4">{{ Str::limit($post->synopsis, 100) }}</p>
                <div class="mt-auto flex items-center justify-between">
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $post->created_at->format('d/m/Y H:i') }}
                    </span>
                    <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-600 hover:text-blue-800 dark:hover:text-blue-400 text-sm">
                        Lire plus
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection