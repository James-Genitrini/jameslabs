@extends('layouts.app')

@section('content')
    <article class="bg-white p-6 rounded-lg shadow-md max-w-4xl mx-auto mt-8">
        <!-- Section de l'en-tête avec l'image carrée, le titre et le synopsis -->
        <header class="flex items-start mb-8">
            @if($post->hasMedia('thumbnail'))
                <div class="w-1/3 bg-gray-200 overflow-hidden rounded-lg">
                    <img src="{{ $post->getFirstMediaUrl('thumbnail', 'preview') }}" alt="{{ $post->title }}" class="object-cover w-full h-full">
                </div>
            @endif
            <div class="ml-6 flex flex-col justify-start w-2/3">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $post->title }}</h1>
                @if($post->synopsis) 
                    <p class="text-md italic text-gray-700">{{ $post->synopsis }}</p>
                @else
                    <p class="text-md text-gray-700">Pas de synopsis disponible.</p>
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
    <!-- Zone d'interaction : Like + Commentaires -->
    <section class="max-w-4xl mx-auto mt-8 space-y-8">

        <!-- ❤️ Like -->
        <div class="flex items-center justify-between">
            @auth
                @if ($post->isLikedBy(auth()->user()))
                    <form action="{{ route('posts.unlike', $post) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex items-center text-red-500 hover:text-red-700">
                            ❤️ <span class="ml-1">Retirer le like ({{ $post->likes()->count() }})</span>
                        </button>
                    </form>
                @else
                    <form action="{{ route('posts.like', $post) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        <button type="submit" class="flex items-center text-gray-500 hover:text-gray-700">
                            🤍 <span class="ml-1">Liker ({{ $post->likes()->count() }})</span>
                        </button>
                    </form>
                @endif
            @else
                <p class="text-sm text-gray-500">Connecte-toi pour liker ce post. ❤️</p>
            @endauth
        </div>

        <!-- 💬 Commentaires -->
        <div class="bg-white p-6 rounded-lg shadow space-y-4">
            <h2 class="text-xl font-semibold text-gray-800">Commentaires ({{ $post->comments()->count() }})</h2>

            <!-- Liste des commentaires -->
            <div class="space-y-3">
                @forelse($post->comments()->latest()->get() as $comment)
                    <div class="border-t pt-3 text-sm text-gray-700">
                        <p class="mb-1">{{ $comment->comment }}</p>
                        <span class="text-xs text-gray-500">Par {{ $comment->user->name ?? 'Anonyme' }}, le {{ $comment->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Aucun commentaire pour l’instant.</p>
                @endforelse
            </div>

            {{-- <!-- Formulaire de commentaire -->
            @auth
                <form action="{{ route('comments.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="commentable_type" value="App\Models\Post">
                    <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                    <textarea name="comment" rows="3" class="w-full border border-gray-300 rounded p-2 focus:outline-none focus:ring focus:border-blue-300" placeholder="Votre commentaire..."></textarea>
                    <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Envoyer</button>
                </form>
            @else
                <p class="text-sm text-gray-500">Connecte-toi pour laisser un commentaire.</p>
            @endauth --}}
        </div>

    </section>
    
@endsection