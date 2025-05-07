@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-center mb-6 text-gray-400">Bienvenue sur JamesLabs !</h1>
    <p class="text-center mb-6 text-gray-400">Découvrez les derniers posts</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $post)
    <div class="bg-[#f2e3fa] text-gray-900 p-6 rounded-lg shadow-md flex flex-col h-full"
     style="border-top: 25px solid #c6a2da94;">
                <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>
                @if($post->hasMedia('thumbnail'))
                    <div class="w-full h-48 bg-gray-200 overflow-hidden rounded-lg mb-4">
                        <img src="{{ $post->getFirstMediaUrl('thumbnail', 'preview') }}" alt="{{ $post->title }}" class="object-cover w-full h-full">
                    </div>
                @endif
                <p class="text-gray-600 dark:text-gray-300 mb-4">{{ Str::limit($post->synopsis, 200) }}</p>
                @if($post->tags && count($post->tags) > 0)
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach($post->tags as $tag)
                        <span class="inline-block py-1 px-3 rounded-full text-sm"
                              style="background-color: #e1c0f2;">
                            #{{ $tag }}
                        </span>
                    @endforeach
                </div>
                @endif
                <br>
                <div class="mt-auto flex items-center justify-between">
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $post->created_at->format('d/m/Y H:i') }}
                    </span>
                    
                </div>
                <div class="mt-2 text-sm text-gray-600 dark:text-gray-400 flex items-center gap-1">
                    {{ $post->likes()->count() }}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                
                    {{ $post->comments_count }}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                    </svg>
                
                    <a href="{{ route('posts.show', $post->slug) }}"
                       class="ml-auto text-blue-500 hover:text-purple-400 text-sm">
                        Lire plus
                    </a>
                </div>
                

            </div>
        @endforeach
    </div>
@endsection