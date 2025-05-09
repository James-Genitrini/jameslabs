<div class="space-y-3 mb-8 max-h-[calc(100vh-200px)]">
    @forelse($post->comments()->latest()->get() as $comment)
        @php
            $isAuthor = auth()->check() && auth()->user()->id === $comment->user_id;
        @endphp

        <div class="flex items-start gap-4">
            @if($comment->user->profile_picture)
                <img src="{{ asset('storage/' . $comment->user->profile_picture) }}" alt="photo" class="rounded-full w-16 h-16 object-cover">
            @else
                <div class="rounded-full bg-gray-200 w-16 h-16 flex items-center justify-center text-gray-400 cursor-pointer">
                    <img src='img/noprofile.png' alt="photo" class="rounded-full w-16 h-16 object-cover">
                </div>
            @endif

            <div class="relative {{ $isAuthor ? 'bg-[#2d1f38] text-gray-200' : 'bg-[#2a2a3b] text-gray-300' }} p-3 rounded-lg max-w-xl w-full">
                @if ($isAuthor || auth()?->user()?->is_admin)
                    <form action="{{ route('posts.comments.destroy', [$post, $comment]) }}" method="POST" class="absolute top-2 right-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700" title="Supprimer le commentaire">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M10 3h4a1 1 0 011 1v1H9V4a1 1 0 011-1z" />
                            </svg>
                        </button>
                    </form>
                @endif
                <p class="mb-1">{{ $comment->comment }}</p>
                <span class="text-xs text-gray-400">
                    Par {{ $comment->user->name ?? 'Anonyme' }}, le {{ $comment->created_at->format('d/m/Y H:i') }}
                </span>
            </div>
        </div>
    @empty
        <p class="text-sm text-gray-500">Aucun commentaire pour l’instant.</p>
    @endforelse
</div>