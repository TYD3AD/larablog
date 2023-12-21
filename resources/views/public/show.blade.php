<x-guest-layout>
    <div class="text-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $article->title }}
        </h2>
    </div>

    <div class="text-gray-500 text-sm">
        Publié le {{ $article->created_at->format('d/m/Y') }} par <a href="{{ route('public.index', $article->user->id) }}">{{ $article->user->name }}</a>
    </div>

    <div>
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <p class="text-gray-700 dark:text-gray-300">{{ $article->content }}</p>
        </div>
    </div>
    <!-- Ajout d'un commentaire -->
    @auth
    <!-- Le code affiché si la personne est connecté -->

    <form action="{{ route('comments.store') }}" method="post" class="mt-6">
        @csrf
        <input type="hidden" name="articleId" value="{{ $article->id }}">
        <label for="content" class="text-white">Votre commentaire</label>
        <input type="text" name="content">
        <input type="submit" name="envoyer" class="text-white">

        <!-- Ajouter le reste de votre formulaire -->
    </form>
    @endauth
    <div>
        @foreach ($article->comments as $com)
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <p class="text-gray-700 dark:text-gray-300">{{ $com->content }}</p>
        </div>
    </div>
    @endforeach
</x-guest-layout>