<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Your Recipes</h3>
                    <a href="{{ route('recipes.create') }}"
                       class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded shadow">
                        + Add Recipe
                    </a>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-4 text-green-600 font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($recipes->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">You haven't added any recipes yet.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($recipes as $recipe)
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $recipe->name }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $recipe->type }} | {{ $recipe->cookingtime }} mins</p>

                                <a href="{{ route('recipes.show', ['recipe' => $recipe->rid]) }}"
                                   class="text-indigo-600 dark:text-indigo-400 hover:underline mt-2 inline-block">
                                    View Recipe
                                </a>

                                <div class="mt-2 flex gap-4">
                                    <a href="{{ route('recipes.edit', ['recipe' => $recipe->rid]) }}"
                                       class="text-yellow-500 hover:underline">Edit</a>

                                    <form action="{{ route('recipes.destroy', ['recipe' => $recipe->rid]) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this recipe?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
