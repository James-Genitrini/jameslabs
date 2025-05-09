@auth
    <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="commentable_type" value="App\Models\Post">
        <input type="hidden" name="commentable_id" value="{{ $post->id }}">
        <textarea name="comment" rows="2"
                class="w-full border border-gray-700 bg-[#12121c] text-gray-200 rounded p-2 focus:outline-none focus:ring-2 focus:ring-[#9471a6] focus:border-[#9471a6]"
                placeholder="Votre commentaire..." style="resize: none;"></textarea>
        <button type="submit" class="mt-2 bg-[#2d1f38] text-white px-4 py-2 rounded hover:bg-[#7b5e91]">
            Envoyer
        </button>
    </form>
    @if ($errors->any())
        <div class="mt-4">
            <ul class="list-disc list-inside text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@else
    <p class="text-sm text-gray-400 mt-4">Connecte-toi pour laisser un commentaire.</p>
@endauth