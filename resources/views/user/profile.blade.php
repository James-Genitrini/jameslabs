@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-8 p-6 bg-cream dark:bg-gray-800 rounded-lg shadow-md">
    <h1 class="text-3xl font-semibold text-center text-[#9471a6] dark:text-gray-100 mb-6">Modifier mon profil</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-6">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Photo de profil -->
        <div class="flex justify-center mb-6">
            <div class="relative">
                <img 
                    src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('img/noprofile.png') }}" 
                    id="profile-picture" 
                    alt="photo" 
                    class="rounded-full w-32 h-32 object-cover cursor-pointer"
                >
                
                <input type="file" name="profile_picture" id="profile-picture-input"
                    class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewImage(event)">
            </div>
        </div>

        <!-- Nom -->
        <div class="mb-4">
            <label for="name" class="block text-lg font-medium text-gray-400 dark:text-gray-300">Nom</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                   class="mt-2 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-lg font-medium text-gray-400 dark:text-gray-300">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                   class="mt-2 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <!-- Mot de passe -->
        <div class="mb-4">
            <label for="password" class="block text-lg font-medium text-gray-400 dark:text-gray-300">Mot de passe (laisser vide si inchangé)</label>
            <input type="password" name="password" id="password"
                   class="mt-2 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <!-- Confirmer le mot de passe -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-lg font-medium text-gray-400 dark:text-gray-300">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="mt-2 p-3 w-full border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <!-- Bouton de soumission -->
        <div class="flex justify-center">
            <button type="submit" class="px-6 py-3 bg-[#2d1f38] text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700">
                Mettre à jour
            </button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('profile-picture');
            output.src = reader.result;  // Affiche la nouvelle image
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
