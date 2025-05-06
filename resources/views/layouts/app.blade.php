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
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-roboto flex flex-col h-screen">

    <nav class="bg-gray-100 dark:bg-gray-800 shadow-md fixed top-0 left-0 right-0 z-50 h-16">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-blue-600 dark:text-blue-400">Home</a>
            <div>
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="/auth" class="text-blue-600 mx-4 dark:text-blue-400">Dashboard</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 dark:text-red-400">Se déconnecter</button>
                    </form>
                @else
                    <a href="/auth/login" class="text-blue-600 mx-4 dark:text-blue-400">Se connecter</a>
                @endauth
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