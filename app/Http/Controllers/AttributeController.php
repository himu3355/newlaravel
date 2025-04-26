<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeCategory;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        $categories = AttributeCategory::with('attributes')->orderBy('sort_order')->get();
        return view('backend.attributes.index', compact('categories'));
    }

    public function createAttribute(AttributeCategory $category)
    {
        return view('backend.attributes.create', compact('category'));
    }

    public function storeAttribute(Request $request, AttributeCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'active' => 'nullable',
            'meta_data' => 'nullable|array',
        ]);

        $attribute = new Attribute();
        $attribute->attribute_category_id = $category->id;
        $attribute->name = $validated['name'];
        $attribute->slug = \Str::slug($validated['name']);
        $attribute->description = $validated['description'];
        $attribute->sort_order = $validated['sort_order'] ?? 0;
        $attribute->active = $request->has('active');

        if ($request->has('meta_data')) {
            $attribute->meta_data = $validated['meta_data'];
        }

        $attribute->save();

        return redirect()->route('admin.attributes.index')
            ->with('success', 'Attribute created successfully.');
    }

    public function editAttribute(Attribute $attribute)
    {
        return view('backend.attributes.edit', compact('attribute'));
    }

    public function updateAttribute(Request $request, Attribute $attribute)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'active' => 'nullable',
            'meta_data' => 'nullable|array',
        ]);

        $attribute->name = $validated['name'];
        // Update slug only if name changed
        if ($attribute->isDirty('name')) {
            $attribute->slug = \Str::slug($validated['name']);
        }
        $attribute->description = $validated['description'];
        $attribute->sort_order = $validated['sort_order'] ?? 0;
        $attribute->active = $request->has('active');

        if ($request->has('meta_data')) {
            $attribute->meta_data = $validated['meta_data'];
        }

        $attribute->save();

        return redirect()->route('admin.attributes.index')
            ->with('success', 'Attribute updated successfully.');
    }

    public function destroyAttribute(Attribute $attribute)
    {
        $attribute->delete();
        return redirect()->route('admin.attributes.index')
            ->with('success', 'Attribute deleted successfully.');
    }
}
