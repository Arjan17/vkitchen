<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $recipes = Recipe::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('type', 'like', "%{$search}%");
            })
            ->get();

        return view('welcome', compact('recipes'));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'type' => 'required|string',
            'cookingtime' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('recipes', 'public');
        }

        $validated['uid'] = auth()->id();

        Recipe::create($validated);

        return redirect()->route('dashboard')->with('success', 'Recipe added successfully!');
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        $this->authorizeAction($recipe);
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $this->authorizeAction($recipe);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'cookingtime' => 'required|integer|min:1',
            'instructions' => 'required|string',
            'type' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($recipe->image) {
                Storage::disk('public')->delete($recipe->image);
            }
            $validated['image'] = $request->file('image')->store('recipes', 'public');
        }

        $recipe->update($validated);

        return redirect()->route('dashboard')->with('success', 'Recipe updated successfully!');
    }

    public function destroy(Recipe $recipe)
    {
        $this->authorizeAction($recipe);

        if ($recipe->image) {
            Storage::disk('public')->delete($recipe->image);
        }

        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully!');
    }

    public function dashboard()
    {
        $recipes = Recipe::where('uid', auth()->id())->get();
        return view('dashboard', compact('recipes'));
    }

    private function authorizeAction(Recipe $recipe)
    {
        if ($recipe->uid !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}