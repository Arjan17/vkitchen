<x-app-layout>
    <div class="border p-6 rounded-lg">
        <h2 class="text-3xl font-semibold">Add a New Recipe</h2>
        
        <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data" class="mt-6">
            @csrf

      
            <div>
                <x-input-label for="name" :value="__('Recipe Name')" />
                <x-text-input id="name" name="name" type="text" required class="block mt-1 w-full" value="{{ old('name') }}" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" name="description" required class="block mt-1 w-full">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

       
            <div class="mt-4">
                <x-input-label for="ingredients" :value="__('Ingredients')" />
                <textarea id="ingredients" name="ingredients" required class="block mt-1 w-full">{{ old('ingredients') }}</textarea>
                <x-input-error :messages="$errors->get('ingredients')" class="mt-2" />
            </div>

         
            <div class="mt-4">
                <x-input-label for="instructions" :value="__('Instructions')" />
                <textarea id="instructions" name="instructions" required class="block mt-1 w-full">{{ old('instructions') }}</textarea>
                <x-input-error :messages="$errors->get('instructions')" class="mt-2" />
            </div>

            <select id="type" name="type" required class="block mt-1 w-full">
    <option value="">-- Select Cuisine Type --</option>
    <option value="French" {{ old('type') == 'French' ? 'selected' : '' }}>French</option>
    <option value="Italian" {{ old('type') == 'Italian' ? 'selected' : '' }}>Italian</option>
    <option value="Chinese" {{ old('type') == 'Chinese' ? 'selected' : '' }}>Chinese</option>
    <option value="Indian" {{ old('type') == 'Indian' ? 'selected' : '' }}>Indian</option>
    <option value="Mexican" {{ old('type') == 'Mexican' ? 'selected' : '' }}>Mexican</option>
    <option value="Others" {{ old('type') == 'Others' ? 'selected' : '' }}>Others</option>
</select>


<div class="mt-4">
    <x-input-label for="cookingtime" :value="__('Cooking Time (minutes)')" />
    <x-text-input id="cookingtime" class="block mt-1 w-full" type="number" name="cookingtime" required />
    <x-input-error :messages="$errors->get('cookingtime')" class="mt-2" />
</div>



           
<div class="mt-4">
    <x-input-label for="image" :value="__('Image (Optional)')" />
    <input type="file" id="image" name="image" class="block mt-1 w-full text-gray-900 dark:text-gray-100" />
    <x-input-error :messages="$errors->get('image')" class="mt-2" />
</div>


            <x-primary-button class="mt-6">
                {{ __('Save Recipe') }}
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
