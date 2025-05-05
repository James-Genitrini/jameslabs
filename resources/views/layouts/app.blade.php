<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="bg-gray-100 font-roboto">
    <header class="bg-white shadow-md p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-blue-600">Mon Blog</a>
            <div>
                @auth
                    <a href="/admin" class="text-blue-600 mx-4">Admin</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600">Se déconnecter</button>
                    </form>
                @else
                    <a href="/admin" class="text-blue-600 mx-4">Se connecter</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="container mx-auto py-6">
        @yield('content')
    </main>

    <footer class="bg-white text-center py-4 shadow-md">
        <p>&copy; {{ date('Y') }} Mon Blog - Tous droits réservés</p>
    </footer>
</body>
</html>