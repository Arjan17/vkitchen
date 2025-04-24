<x-app-layout>
    <div class="border p-6 rounded-lg">
        <h2 class="text-3xl font-semibold">Edit Recipe</h2>

        @if ($errors->any())
            <div class="text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('recipes.update', ['recipe' => $recipe->rid]) }}" enctype="multipart/form-data" class="mt-6">
            @csrf
            @method('PUT')

            
            <div>
                <x-input-label for="name" :value="__('Recipe Name')" />
                <x-text-input id="name" name="name" type="text" required class="block mt-1 w-full" value="{{ old('name', $recipe->name) }}" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" name="description" required class="block mt-1 w-full">{{ old('description', $recipe->description) }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

       
            <div class="mt-4">
                <x-input-label for="ingredients" :value="__('Ingredients')" />
                <textarea id="ingredients" name="ingredients" required class="block mt-1 w-full">{{ old('ingredients', $recipe->ingredients) }}</textarea>
                <x-input-error :messages="$errors->get('ingredients')" class="mt-2" />
            </div>

           
            <div class="mt-4">
                <x-input-label for="instructions" :value="__('Instructions')" />
                <textarea id="instructions" name="instructions" required class="block mt-1 w-full">{{ old('instructions', $recipe->instructions) }}</textarea>
                <x-input-error :messages="$errors->get('instructions')" class="mt-2" />
            </div>

        
            <div class="mt-4">
                <x-input-label for="type" :value="__('Type')" />
                <x-text-input id="type" name="type" type="text" required class="block mt-1 w-full" value="{{ old('type', $recipe->type) }}" />
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

          
            <div class="mt-4">
                <x-input-label for="cookingtime" :value="__('Cooking Time (in minutes)')" />
                <x-text-input id="cookingtime" name="cookingtime" type="number" required class="block mt-1 w-full" value="{{ old('cookingtime', $recipe->cookingtime) }}" />
                <x-input-error :messages="$errors->get('cookingtime')" class="mt-2" />
            </div>

      
            <div class="mt-4">
                <x-input-label for="image" :value="__('Image (Optional)')" />
                <input id="image" name="image" type="file" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <x-primary-button class="mt-6">
                {{ __('Save Changes') }}
            </x-primary-button>
        </form>
    </div>
</x-app-layout>