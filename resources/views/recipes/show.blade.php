<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        
        <h2 class="text-3xl font-semibold text-gray-800">{{ $recipe->name }}</h2>
        <p class="text-lg text-gray-600 mt-2">{{ $recipe->description }}</p>

        <!-- Recipe Image -->
        <div class="mt-6">
            <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->name }}" class="w-full h-64 object-cover rounded-lg">
        </div>

        <!-- Ingredients Section -->
        <div class="mt-6">
            <h3 class="text-xl font-bold text-gray-800">Ingredients</h3>
            <ul class="list-disc ml-6 mt-2">
                @foreach (explode(',', $recipe->ingredients) as $ingredient)
                    <li class="text-gray-700">{{ $ingredient }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Instructions Section -->
        <div class="mt-6">
            <h3 class="text-xl font-bold text-gray-800">Instructions</h3>
            <p class="text-gray-700 mt-2">{{ $recipe->instructions }}</p>
        </div>
    </div>
</x-app-layout>
