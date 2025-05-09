@extends('layouts.app')

@section('content')
    <article class="bg-cream p-6 rounded-lg shadow-md max-w-7xl mx-auto mt-8 flex flex-col md:flex-row gap-8" style="height: 75vh;">
        
        <!-- Section Article -->
        <div class="flex-1 w-full md:w-3/4 h-full overflow-auto">
            <header class="flex items-start mb-8">
                @if($post->hasMedia('thumbnail'))
                    <div class="w-1/3 bg-gray-200 overflow-hidden rounded-lg">
                        <img src="{{ $post->getFirstMediaUrl('thumbnail', 'preview') }}" alt="{{ $post->title }}" class="object-cover w-full h-full">
                    </div>
                @endif
                <div class="ml-6 flex flex-col justify-start w-2/3">
                    <h1 class="text-4xl font-bold text-gray-300 mb-2">{{ $post->title }}</h1>
                    @if($post->synopsis) 
                        <p class="text-md italic text-gray-300">{{ $post->synopsis }}</p>
                    @else
                        <p class="text-md text-gray-300">Pas de synopsis disponible.</p>
                    @endif
                </div>
            </header>

            <section class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-300 mb-4">Contenu de l'article</h2>
                <div class="prose max-w-none">
                    {!! Str::markdown($post->content) !!}
                </div>
            </section>

            <footer class="text-sm text-gray-400 mt-8">
                <div class="mt-2">
                    <span class="font-semibold">Crédit : </span>{{ $post->created_at->format('d/m/Y H:i') }} par J.G.
                </div>
            </footer>
        </div>

        <div class="w-full md:w-1/4 bg-neutral-800 text-gray-200 p-6 rounded-lg max-h-screen">
            <!-- Like -->
            <x-like-component :post="$post" />

            <div class="space-y-3 mb-6 overflow-y-auto" style="max-height: 35vh;">
                <x-comment-list :post="$post" />
            </div>

            <!-- Formulaire de commentaire -->
            <x-comment-form :post="$post" />
        </div>
    </article>
@endsection