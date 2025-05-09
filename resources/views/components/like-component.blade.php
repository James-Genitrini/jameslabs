<div class="mb-8">
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
</div>