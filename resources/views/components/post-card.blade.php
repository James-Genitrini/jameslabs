@props(['post'])

<div class="bg-[#e8d8f0] text-gray-900 p-6 rounded-lg shadow-md flex flex-col h-full group relative"
     style="border-top: 25px solid #c6a2da94;">
    @auth
        @if(auth()->user()->is_admin)
            {{-- Bouton d'édition (stylo) --}}
            <a href="{{ url('auth/posts/' . $post->id . '/edit') }}" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l2.121 2.121a2.25 2.25 0 0 1 0 3.182l-9.9 9.9a2.25 2.25 0 0 1-.707.5l-3.75 1.25a1.125 1.125 0 0 1-1.362-1.362l1.25-3.75a2.25 2.25 0 0 1 .5-.707l9.9-9.9a2.25 2.25 0 0 1 3.182 0zM15.75 6l-9 9m12-6h3v3m-3-3v3m3-3h-3" />
                </svg>
            </a>
        @endif
    @endauth

    <h2 class="text-xl font-semibold mb-2">{{ $post->title }}</h2>

    @if($post->tags && count($post->tags) > 0)
        <div class="mt-4 flex flex-wrap gap-2">
            @foreach($post->tags as $tag)
                <span class="inline-block py-1 px-3 rounded-full text-sm" style="background-color: #d6a8ed;">
                    {{ $tag }}
                </span>
            @endforeach
        </div>
        <br>
    @endif

    @if($post->hasMedia('thumbnail'))
        <div class="w-full h-48 bg-gray-200 overflow-hidden rounded-lg mb-4">
            <img src="{{ $post->getFirstMediaUrl('thumbnail', 'preview') }}" alt="{{ $post->title }}" class="object-cover w-full h-full">
        </div>
    @else
        <div class="w-full h-48 bg-gray-200 overflow-hidden rounded-lg mb-4">
            <img src="{{ asset('img/noimage.jpg') }}" alt="Default Thumbnail" class="object-cover w-full h-full">
        </div>
    @endif

    <div class="mt-auto flex items-center justify-between">
        <span class="text-sm text-gray-500 dark:text-gray-400">
            {{ $post->created_at->format('d/m/Y H:i') }}
        </span>
    </div>

    <div class="mt-auto pt-4 flex items-center justify-between text-sm text-gray-600">
        
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-1">
                @auth
                    @if ($post->isLikedBy(auth()->user()))
                        <form action="{{ route('posts.unlike', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-pink-500 cursor-pointer hover:text-pink-600">❤️</button>
                        </form>
                    @else
                        <form action="{{ route('posts.like', $post) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-400 cursor-pointer hover:text-gray-600">🤍</button>
                        </form>
                    @endif
                @endauth
                <span>{{ $post->likes()->count() }}</span>
            </div>

            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM8.25 9.75h.375m3.75 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM12 9.75h.375m3.75 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM15.75 9.75h-.375M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3a48.394 48.394 0 0 0-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                </svg>
                <span>{{ $post->comments_count }}</span>
            </div>

            <button onclick="copyToClipboard('{{ route('posts.show', $post->slug) }}')" class="text-gray-400 hover:bg-[#c6a2da94] hover:text-gray-600 transition cursor-pointer">
                <img src="{{ asset('img/share.svg') }}" alt="Partager" class="w-4 h-4">
            </button>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('posts.show', $post->slug) }}"
               class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700">
                Lire plus →
            </a>
        </div>

    </div>
</div>