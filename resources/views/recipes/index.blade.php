<x-app-layout>
    <h2 class="text-2xl font-semibold">Recipe List</h2>

    
    <form method="GET" action="{{ route('recipes.index') }}" class="mt-4">
        <div class="flex items-center">
            <input type="text" name="search" class="border p-2 rounded-l" placeholder="Search by name or type..." value="{{ request('search') }}">
            <button type="submit" class="bg-indigo-500 text-white p-2 rounded-r">Search</button>
        </div>
    </form>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($recipes as $recipe)
            <div class="border p-4 rounded-lg">
                <h3 class="text-xl font-bold">{{ $recipe->name }}</h3>
                <p class="text-gray-600">{{ \Str::limit($recipe->description, 100) }}</p>
                <a href="{{ route('recipes.show', $recipe->id) }}" class="text-indigo-500 hover:text-indigo-700">View Details</a>
            </div>
        @endforeach
    </div>
</x-app-layout>
