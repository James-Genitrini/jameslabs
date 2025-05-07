@extends('layouts.app')

@section('content')
    <article class="bg-cream p-6 rounded-lg shadow-md max-w-4xl mx-auto mt-8">
        <header class="flex items-start mb-8">
            @if($post->hasMedia('thumbnail'))
                <div class="w-1/3 bg-gray-200 overflow-hidden rounded-lg">
                    <img src="{{ $post->getFirstMediaUrl('thumbnail', 'preview') }}" alt="{{ $post->title }}" class="object-cover w-full h-full">
                </div>
            @endif
            <div class="ml-6 flex flex-col justify-start w-2/3">
                <h1 class="text-4xl font-bold text-gray-300" mb-2">{{ $post->title }}</h1>
                @if($post->synopsis) 
                    <p class="text-md italic text-gray-300">{{ $post->synopsis }}</p>
                @else
                    <p class="text-md text-gray-300"">Pas de synopsis disponible.</p>
                @endif
            </div>
        </header>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-300 mb-4">Contenu de l'article</h2>
            <div class="prose max-w-none">
                {!! Str::markdown($post->content) !!}
            </div>
        </section>

        <footer class="text-sm text-gray-400 mt-8 flex flex-col md:flex-row justify-end">
            <div class="mt-2 md:mt-0">
                <span class="font-semibold">Crédit : </span>{{ $post->created_at->format('d/m/Y H:i') }} par J.G.
            </div>
        </footer>
    </article>
    <section class="max-w-4xl mx-auto mt-8 space-y-8 bg-neutral-900 text-gray-200">

        {{-- Like --}}
        <div class="flex items-center justify-between">
            @auth
                @if ($post->isLikedBy(auth()->user()))
                    <form action="{{ route('posts.unlike', $post) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex items-center text-pink-400 hover:text-pink-500">
                            ❤️ <span class="ml-1">({{ $post->likes()->count() }})</span>
                        </button>
                    </form>
                @else
                    <form action="{{ route('posts.like', $post) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        <button type="submit" class="flex items-center text-gray-400 hover:text-gray-200">
                            🤍 <span class="ml-1">({{ $post->likes()->count() }})</span>
                        </button>
                    </form>
                @endif
            @else
                <p class="text-sm text-gray-400">Connecte-toi pour liker ce post. ❤️</p>
            @endauth
        </div>
    
        {{-- Commentaires --}}
        <div class="bg-neutral-900 p-6 rounded-lg shadow space-y-4">
            <h2 class="text-xl font-semibold text-[#c2a5db]">Commentaires ({{ $post->comments()->count() }})</h2>
    
            <div class="space-y-3">
                @forelse($post->comments()->latest()->get() as $comment)
                    @php
                        $isAuthor = auth()->check() && auth()->user()->id === $comment->user_id;
                    @endphp
    
                    <div class="flex">
                        <div class="{{ $isAuthor ? 'bg-[#2d1f38] text-gray-200' : 'bg-[#2a2a3b] text-gray-300' }} p-3 rounded-lg max-w-xl w-full">
                            <p class="mb-1">{{ $comment->comment }}</p>
                            <span class="text-xs text-gray-400">
                                Par {{ $comment->user->name ?? 'Anonyme' }}, le {{ $comment->created_at->format('d/m/Y H:i') }}
                            </span>
                        </div>
                    </div>
    
                    @if ($isAuthor || auth()?->user()?->is_admin)
                        <form action="{{ route('posts.comments.destroy', [$post, $comment]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-500 hover:text-red-700">Supprimer</button>
                        </form>
                    @endif
                @empty
                    <p class="text-sm text-gray-500">Aucun commentaire pour l’instant.</p>
                @endforelse
            </div>
    
            {{-- Formulaire --}}
            @auth
                <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="commentable_type" value="App\Models\Post">
                    <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                    <textarea name="comment" rows="3"
                              class="w-full border border-gray-700 bg-[#12121c] text-gray-200 rounded p-2 focus:outline-none focus:ring-2 focus:ring-[#9471a6] focus:border-[#9471a6]"
                              placeholder="Votre commentaire..."></textarea>
                    <button type="submit" class="mt-2 bg-[#2d1f38] text-white px-4 py-2 rounded hover:bg-[#7b5e91]">
                        Envoyer
                    </button>
                </form>
            @else
                <p class="text-sm text-gray-400">Connecte-toi pour laisser un commentaire.</p>
            @endauth
        </div>
    
    </section>
    
@endsection