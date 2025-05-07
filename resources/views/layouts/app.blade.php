<!DOCTYPE html>
<html lang="fr">
<head>
    {{-- <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"> --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-cream dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-roboto flex flex-col h-screen">

    <nav class="bg-white dark:bg-gray-800 shadow-md fixed top-0 left-0 right-0 z-50 py-4">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <!-- Logo et Titre -->
            <a href="/" class="text-2xl font-bold text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition">
                {{ config('app.name', 'Laravel') }}
            </a>
            
            <div class="flex items-center space-x-6">

                <!-- Lien vers le dashboard (Admin) -->
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="/auth" class="text-lg text-gray-600 dark:text-gray-200 hover:text-blue-600 dark:hover:text-blue-400 transition">Dashboard</a>
                    @endif
                @endauth

                <!-- Boutons de connexion / déconnexion -->
                <div class="flex items-center space-x-4">
                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-600 transition">
                                Se déconnecter
                            </button>
                        </form>

                        <!-- Photo de profil -->
                        <a href="{{ route('profile.show') }}" class="relative inline-block">
                            <img 
                                src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/default-profile.png') }}" 
                                alt="Profile"
                                class="w-10 h-10 rounded-full object-cover border-2 border-blue-500 hover:border-blue-600 transition"
                            >
                        </a>
                    @else
                        <a href="/auth/login" class="text-lg text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition">Se connecter</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <main class="container mx-auto pt-2 pb-6 px-4 flex-1 mt-16">
        @yield('content')
    </main>

    <footer class="bg-gray-100 dark:bg-gray-800 text-center py-4 shadow-md text-gray-700 dark:text-gray-300">
        <p>&copy; {{ date('Y') }} JamesLabs - Tous droits réservés</p>
    </footer>

</body>
</html>