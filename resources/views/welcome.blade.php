<x-guest-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Welcome Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-gray-800">Welcome to Virtual Kitchen</h1>
            <p class="text-lg text-gray-600 mt-2">Explore and share delicious recipes with the world!</p>
        </div>

        <!-- Recipe Search Bar -->
        <div class="mb-8 text-center">
            <form action="{{ route('welcome') }}" method="GET" class="max-w-lg mx-auto">
                <div class="flex items-center border-2 border-gray-300 rounded-lg overflow-hidden">
                    <input type="text" name="search" class="w-full py-2 px-4 text-lg" placeholder="Search recipes..." value="{{ request()->get('search') }}" />
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Display Recipes -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse ($recipes as $recipe)
                <div class="border border-gray-300 rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $recipe->name }}</h3>
                        <p class="text-sm text-gray-500 mt-2">{{ Str::limit($recipe->description, 100) }}</p>
                        <a href="{{ route('recipes.show', $recipe) }}" class="text-blue-600 hover:underline mt-4 inline-block">View Recipe</a>                    </div>
                </div>
            @empty
                <div class="col-span-1 sm:col-span-2 md:col-span-3 lg:col-span-4 text-center text-gray-500">
                    <p>No recipes found. Please check back later.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-guest-layout>