<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifier l'article {{ $article->id }}
        </h2>
    </x-slot>
    <!-- Message flash -->
    @if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded-lg mt-6 mb-6 text-center">
        {{ session('success') }}
    </div>
    @endif
    <form method="post" action="{{ route('articles.update', $article->id) }}" class="py-12">
        @csrf
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Input de titret de l'article -->
                    <input type="text" value="{{ $article->title }}" name="title" id="title" placeholder="Titre de l'article" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>

                <div class="p-6 pt-0 text-gray-900 dark:text-gray-100">
                    <!-- Contenu de l'article -->
                    <textarea rows="30" name="content" id="content" placeholder="Contenu de l'article" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $article->content }}</textarea>
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                    <!-- Action sur le formulaire -->
                    <div class="grow">
                        <input type="checkbox" name="draft" id="draft" {{ $article->draft ? 'checked' : '' }} class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <label for="draft">Article en brouillon</label>
                    </div>
                    <div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Modifier l'article
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
</x-app-layout>