@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-center mb-6 text-gray-400">Tous les posts</h1>

    <div class="flex justify-center mb-10">
        <form method="GET" action="{{ route('posts.index') }}"
            class="flex flex-col sm:flex-row items-center gap-4 bg-white px-6 py-4 rounded-lg shadow-lg w-full max-w-2xl border border-purple-200">
            
            <input 
                type="text"
                name="search"
                placeholder="Recherche : mot-clé, tag, etc."
                value="{{ request('search') }}"
                class="w-full sm:flex-1 px-4 py-2 rounded border border-gray-300 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-300 bg-white"
            />
    
            <button 
                type="submit"
                class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition shadow-md">
                Rechercher
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($posts as $post)
            <x-post-card :post="$post" />
        @endforeach
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>
@endsection
