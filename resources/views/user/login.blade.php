@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-20 p-6 bg-cream dark:bg-gray-800 rounded-lg shadow-md">
        <h1 class="text-3xl font-semibold text-center text-[#9471a6] dark:text-gray-100 mb-6">Connexion</h1>

        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-6">{{ session('error') }}</div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-lg font-medium text-gray-400 dark:text-gray-300">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="mt-2 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-lg font-medium text-gray-400 dark:text-gray-300">Mot de
                    passe</label>
                <input type="password" name="password" id="password" required
                    class="mt-2 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="flex items-center mb-4">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm text-gray-500 dark:text-gray-400">Se souvenir de moi</label>
            </div>

            <div class="flex justify-center mb-4">
                <button type="submit"
                    class="px-6 py-3 bg-[#2d1f38] text-white rounded-lg shadow-md hover:bg-[#855f97] focus:outline-none focus:ring-4 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700">
                    Se connecter
                </button>
            </div>

            <div class="text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Pas encore de compte ?
                    <a href="{{ route('register.form') }}"
                        class="text-[#9471a6] dark:text-[#9471a6] hover:underline">S’inscrire</a>
                </p>
            </div>
        </form>
    </div>
@endsection