<!DOCTYPE html>
<html lang="fr">
<head>
    {{-- <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"> --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite('resources/css/app.css')
    <style>
        /* Masquer la barre de défilement pour tout le site tout en permettant le défilement */
        body, html {
            overflow: scroll;  /* Permet le défilement */
            scrollbar-width: none; /* Masque la barre de défilement sur Firefox */
        }

        /* Masquer la barre de défilement pour les navigateurs basés sur Webkit (Chrome, Safari) */
        body::-webkit-scrollbar, html::-webkit-scrollbar {
            display: none;
        }
    </style>

</head>
<body class="bg-neutral-900 text-gray-100 font-roboto flex flex-col h-screen">

    <nav class="bg-zinc-900	 dark:bg-gray-800 shadow-md fixed top-0 left-0 right-0 z-50 py-4">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <!-- Logo et Titre -->
            <a href="/" class="text-2xl font-bold text-[#9471a6] dark:text-blue-400 hover:text-[#7b5e91] dark:hover:text-blue-300 transition">
                {{ config('app.name', 'Laravel') }}
            </a>
            
            <div class="flex items-center space-x-6">

                <!-- Lien vers le dashboard (Admin) -->
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="/auth" class="text-lg text-[#9471a6] hover:text-[#7b5e91] transition">Dashboard</a>
                    @endif
                @endauth

                <!-- Boutons de connexion / déconnexion -->
                <div class="flex items-center space-x-4">
                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-lg text-red-500 dark:text-red-400 hover:text-red-800 dark:hover:text-red-600 transition">
                                Déconnexion
                            </button>
                        </form>

                        <!-- Photo de profil -->
                        <a href="{{ route('profile.show') }}" class="relative inline-block">
                            <img 
                                src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('img/noprofile.png') }}"
                                alt="Profile"
                                class="w-10 h-10 rounded-full object-cover border-2 border-[#9471a6] hover:text-[#7b5e91] transition"
                            >
                        </a>
                    @else
                        <a href="/login" class="text-lg text-[#9471a6] dark:text-[#9471a6] hover:text-[#7b5e91] dark:hover:text-blue-300 transition">Se connecter</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <main class="container mx-auto pt-2 pb-6 px-4 flex-1 mt-16">
        @yield('content')
    </main>

    <footer class="bg-zinc-900	 dark:bg-gray-700 text-center py-4 shadow-md text-gray-400 dark:text-gray-300">
        <p>&copy; {{ date('Y') }} JamesLabs - Tous droits réservés</p>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    const swiperEls = document.querySelectorAll('.mySwiper');
    swiperEls.forEach(el => {
        new Swiper(el, {
            slidesPerView: 1,
            spaceBetween: 24,
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 4 }
            },
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            }
        });
    });

    // Switch between carousels
    function switchCarousel(type) {
        document.querySelectorAll('.carousel-container').forEach(el => el.classList.add('hidden'));
        document.getElementById('carousel-' + type).classList.remove('hidden');
    }
    function copyToClipboard(text) {
    // Créer un élément temporaire
    const tempInput = document.createElement("input");
    tempInput.value = text;
    document.body.appendChild(tempInput);
    tempInput.select();
    tempInput.setSelectionRange(0, 99999); // pour mobile
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    alert("Texte copié dans le presse-papiers : " + text);
    }

</script>

</body>
</html>