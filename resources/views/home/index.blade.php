@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-center mb-6 text-gray-400">Bienvenue sur JamesLabs !</h1>
    <p class="text-center mb-6 text-gray-400">Découvrez nos meilleurs contenus</p>

    <div class="flex justify-center space-x-4 mb-6">
        <button onclick="switchCarousel('latest')" class="px-4 py-2 bg-purple-700 text-white rounded hover:bg-purple-800 transition">Nouveaux</button>
        <button onclick="switchCarousel('liked')" class="px-4 py-2 bg-purple-700 text-white rounded hover:bg-purple-800 transition">Trending</button>
    </div>

    {{-- Carrousels --}}
    <div id="carousel-latest" class="carousel-container">
        <div class="swiper mySwiper mb-10">
            <div class="swiper-wrapper">
                @foreach($latestPosts as $post)
                    <div class="swiper-slide">
                        <x-post-card :post="$post" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="carousel-liked" class="carousel-container hidden">
        <div class="swiper mySwiper mb-10">
            <div class="swiper-wrapper">
                @foreach($mostLikedPosts as $post)
                    <div class="swiper-slide">
                        <x-post-card :post="$post"/>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <br>
    <div class="flex justify-center mb-10">
        <a href="{{ route('posts.index') }}" class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition shadow-md">
            Voir tous les posts
        </a>
    </div>

@endsection