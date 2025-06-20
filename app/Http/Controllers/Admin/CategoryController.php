<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::where('parent_id', null)->get();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|array',
            'description.*' => 'nullable|string',
            'meta_title' => 'nullable|array',
            'meta_title.*' => 'nullable|string|max:255',
            'meta_description' => 'nullable|array',
            'meta_description.*' => 'nullable|string',
            'status' => 'nullable|boolean'
        ]);

        $data = $request->all();
        
        // Generate slug for each language
        $slugs = [];
        foreach ($request->name as $locale => $name) {
            $slugs[$locale] = Str::slug($name);
        }
        $data['slug'] = $slugs;

        $category = Category::create($data);

        if ($request->hasFile('image')) {
            $category->addMediaFromRequest('image')
                ->toMediaCollection('categories');
        }

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)
            ->where('parent_id', null)
            ->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|array',
            'description.*' => 'nullable|string',
            'meta_title' => 'nullable|array',
            'meta_title.*' => 'nullable|string|max:255',
            'meta_description' => 'nullable|array',
            'meta_description.*' => 'nullable|string',
            'status' => 'nullable|boolean'
        ]);

        $data = $request->all();
        
        // Generate slug for each language
        $slugs = [];
        foreach ($request->name as $locale => $name) {
            $slugs[$locale] = Str::slug($name);
        }
        $data['slug'] = $slugs;

        $category->update($data);

        if ($request->hasFile('image')) {
            $category->clearMediaCollection('categories');
            $category->addMediaFromRequest('image')
                ->toMediaCollection('categories');
        }

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Check if category has children
        if ($category->children()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Cannot delete category with subcategories.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    public function toggleStatus(Category $category)
    {
        $category->toggleStatus();
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category status updated successfully.');
    }
} 