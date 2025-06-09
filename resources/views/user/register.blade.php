@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-20 p-6 bg-cream dark:bg-gray-800 rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold text-center text-[#9471a6] dark:text-gray-100 mb-6">Créer un compte</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nom -->
            <div class="mb-4">
                <label for="name" class="block text-lg font-medium text-gray-400 dark:text-gray-300">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                    class="mt-2 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-lg font-medium text-gray-400 dark:text-gray-300">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="mt-2 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <label for="password" class="block text-lg font-medium text-gray-400 dark:text-gray-300">Mot de
                    passe</label>
                <input type="password" name="password" id="password" required
                    class="mt-2 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <!-- Confirmer mot de passe -->
            <div class="mb-6">
                <label for="password_confirmation"
                    class="block text-lg font-medium text-gray-400 dark:text-gray-300">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="mt-2 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <!-- Bouton -->
            <div class="flex justify-center">
                <button type="submit"
                    class="px-6 py-3 bg-[#2d1f38] text-white rounded-lg shadow-md hover:bg-[#855f97] focus:outline-none focus:ring-4 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700">
                    S'inscrire
                </button>
            </div>

            <!-- Lien vers login -->
            <div class="mt-4 text-center">
                Déjà un compte ?
                <a href="{{ route('login') }}" class="text-sm text-[#9471a6] dark:text-[#9471a6] hover:underline">
                    Se connecter
                </a>
            </div>
        </form>
    </div>
@endsection