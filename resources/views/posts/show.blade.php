@extends('layouts.app')

@section('content')
    <article class="bg-cream p-6 rounded-lg shadow-md max-w-7xl mx-auto mt-8 flex flex-col md:flex-row gap-8 relative" style="height: 75vh;">
        
        <!-- Flèche de retour (positionnée en haut à gauche, à l'intérieur du contenu) -->
        <a href="{{ route('posts.index') }}" class="absolute top-4 left-4 text-3xl text-gray-300 hover:text-gray-500 transition z-10">
            &#8592; Retour à la liste des articles
        </a>
        {{-- <button onclick="toggleSidebar()" class="absolute top-4 right-4 bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 z-20">
            Afficher / Masquer commentaires
        </button> --}}


        <!-- Section Article -->
        <div id="mainContent" class="flex-1 w-full md:w-3/4 h-80vh overflow-auto custom-scrollbar mt-14 transition-all duration-300">
            <button onclick="toggleSidebar()" class="sticky top-4 float-right bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700 z-20">
                ⇆
            </button>

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

        <!-- Section Commentaires (visible sur grands écrans uniquement) -->
        <div id="sidebar" class="w-full md:w-1/4 bg-neutral-800 text-gray-200 p-6 rounded-lg max-h-screen transition-all duration-300 hidden-by-toggle">
            <!-- Like -->
            <x-like-component :post="$post" />

            <div class="space-y-3 mb-6 overflow-y-auto custom-scrollbar" style="height: 40vh;">
                <x-comment-list :post="$post" />
            </div>

            <!-- Formulaire de commentaire -->
            <x-comment-form :post="$post" />
        </div>
    </article>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');

            const isHidden = sidebar.classList.contains('hidden-by-toggle');

            if (isHidden) {
                sidebar.classList.remove('hidden-by-toggle');
                mainContent.classList.remove('w-full');
                mainContent.classList.add('md:w-3/4');
            } else {
                sidebar.classList.add('hidden-by-toggle');
                mainContent.classList.remove('md:w-3/4');
                mainContent.classList.add('w-full');
            }
        }
    </script>


    <style>
        /* Masquer les barres de défilement tout en permettant le défilement */
        .custom-scrollbar {
            overflow: scroll;  /* Permet le défilement */
            scrollbar-width: none; /* Masque la barre de défilement sur Firefox */
        }

        .custom-scrollbar::-webkit-scrollbar {
            display: none;  /* Masque la barre de défilement sur Chrome, Safari, et autres navigateurs basés sur Webkit */
        }

        /* Flèche de retour (positionnement absolu) */
        a {
            z-index: 1000; /* Assure que la flèche soit au-dessus du contenu */
            font-weight: bold;
        }

        .hidden-by-toggle {
            display: none !important;
        }

    </style>
@endsection
