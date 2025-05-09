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

        <div id="error-modal" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg max-w-sm w-full">
            <h3 class="text-xl font-semibold text-red-500">Erreur</h3>
            <ul class="list-disc list-inside text-red-500 mt-2" id="error-list">
                <!-- Les erreurs s'afficheront ici -->
            </ul>
            <button id="close-modal" class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Fermer</button>
        </div>
    </div>

    @if ($errors->any())
        <script>
            // Afficher la popup d'erreur
            document.getElementById('error-modal').classList.remove('hidden');

            const errorList = document.getElementById('error-list');
            @foreach ($errors->all() as $error)
                const li = document.createElement('li');
                li.textContent = "{{ $error }}";
                errorList.appendChild(li);
            @endforeach

            // Fermer la popup lorsque l'utilisateur clique sur le bouton "Fermer"
            document.getElementById('close-modal').addEventListener('click', function() {
                document.getElementById('error-modal').classList.add('hidden');
            });
        </script>
    @endif

@else
    <p class="text-sm text-gray-400 mt-4">Connecte-toi pour laisser un commentaire.</p>
@endauth