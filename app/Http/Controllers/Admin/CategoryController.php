<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')
            ->latest()
            ->paginate(10);
            
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'is_active' => 'sometimes|boolean'
        ]);
    
        try {
            // // Handle image upload
            // if ($request->hasFile('image')) {
            //     $validated['image_url'] = $request->file('image')->store('categories', 'public');
            // } else {
            //     $validated['image_url'] = null; // Ensure image_url is set even if no image
            // }
    
            $validated['is_active'] = $request->boolean('is_active', true);
            $validated['slug'] = Str::slug($validated['name']);
            
            $category = Category::create($validated);
    
            return redirect()->route('admin.categories.index')
                ->with('success', 'Category created successfully!');
    
        } catch (\Exception $e) {
            Log::error('Category Store Error: '.$e->getMessage());
            return back()->withInput()
                ->with('error', 'Error creating category: '.$e->getMessage());
        }
    }

    public function show(Category $category)
    {
        $category->load(['products' => function($query) {
            $query->with('media')->latest()->take(5);
        }]);
        
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
            'description' => 'nullable|string',
            'is_active' => 'sometimes|boolean'
        ]);
    
        // Force boolean conversion
        $validated['is_active'] = (bool)($request->input('is_active', false));
        $validated['slug'] = Str::slug($validated['name']);
    
        // Debugging - check what will be updated
        \Log::info('Updating category with:', $validated);
    
        $category->update($validated);
    
        return redirect()->route('admin.categories.index')
               ->with('success', 'Category updated successfully!');
    }

    

    public function destroy(Category $category)
    {
        $category->delete();
        
        return redirect()->route('admin.categories.index')
               ->with('success', 'Category deleted successfully!');
    }

}