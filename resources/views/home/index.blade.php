@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-center mb-6 text-gray-400">Bienvenue sur JamesLabs !</h1>
    <p class="text-center mb-6 text-gray-400">Découvrez les derniers posts</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($latestPosts as $post)
        <x-post-card :post="$post" />
    @endforeach
    </div>
    <br>
    <div class="flex justify-center mb-10">
        <a href="{{ route('posts.index') }}" class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition shadow-md">
            Voir tous les posts
        </a>
    </div>

@endsection