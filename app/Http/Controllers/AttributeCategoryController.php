<?php

namespace App\Http\Controllers;

use App\Models\AttributeCategory;
use Illuminate\Http\Request;

class AttributeCategoryController extends Controller
{
    public function create()
    {
        return view('backend.attributes.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'filterable' => 'nullable',
            'active' => 'nullable',
        ]);
        $category = new AttributeCategory();
        $category->name = $validated['name'];
        $category->slug = \Str::slug($validated['name']);
        $category->description = $validated['description'];
        $category->sort_order = $validated['sort_order'] ?? 0;
        $category->filterable = $request->has('filterable');
        $category->active = $request->has('active');
        $category->save();

        return redirect()->route('admin.attributes.index')
            ->with('success', 'Attribute Category created successfully.');
    }

    public function edit(AttributeCategory $category)
    {
        return view('backend.attributes.categories.edit', compact('category'));
    }

    public function update(Request $request, AttributeCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'filterable' => 'nullable',
            'active' => 'nullable',
        ]);

        $category->name = $validated['name'];
        // Update slug only if name changed
        if ($category->isDirty('name')) {
            $category->slug = \Str::slug($validated['name']);
        }
        $category->description = $validated['description'];
        $category->sort_order = $validated['sort_order'] ?? 0;
        $category->filterable = $request->has('filterable');
        $category->active = $request->has('active');
        $category->save();

        return redirect()->route('admin.attributes.index')
            ->with('success', 'Attribute Category updated successfully.');
    }

    public function destroy(AttributeCategory $category)
    {
        // This will also delete all associated attributes due to cascade delete
        $category->delete();
        return redirect()->route('admin.attributes.index')
            ->with('success', 'Attribute Category and all associated attributes deleted successfully.');
    }
}
