@extends('layouts.app')

@section('content')
    <article class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto mt-8">
        <!-- Section de l'en-tête avec l'image carrée, le titre et le synopsis -->
        <header class="flex items-start mb-8">
            @if($post->hasMedia('thumbnail'))
            <div class="w-48 h-48 bg-gray-200 overflow-hidden border-2 rounded-lg md:w-36 md:h-36">
                <img src="{{ $post->getFirstMediaUrl('thumbnail', 'preview') }}" alt="{{ $post->title }}" class="object-cover w-full h-full">
                </div>
            @endif
            <div class="ml-6 flex flex-col justify-start">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $post->title }}</h1>
                @if($post->synopsis) 
                    <p class="text-lg text-gray-700">{{ $post->synopsis }}</p>
                @else
                    <p class="text-lg text-gray-700">Pas de synopsis disponible.</p>
                @endif
            </div>
        </header>

        <!-- Section du contenu du post -->
        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Contenu de l'article</h2>
            <div class="prose max-w-none">
                {!! Str::markdown($post->content) !!}
            </div>
        </section>

        <!-- Section des informations supplémentaires (slug et publication) -->
        <footer class="text-sm text-gray-500 mt-8 flex flex-col md:flex-row justify-between items-start">
            <div>
                <span class="font-semibold">Slug : </span>{{ $post->slug }}
            </div>
            <div class="mt-2 md:mt-0">
                <span class="font-semibold">Crédit : </span>{{ $post->created_at->format('d/m/Y H:i') }} par J.G.
            </div>
        </footer>
    </article>
@endsection