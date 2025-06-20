<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // List all sections
    public function sections()
    {
        return response()->json(Section::all());
    }

    // Create a new section
    public function storeSection(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:sections,name',
            'label' => 'required|string',
        ]);
        $section = Section::create($validated);
        return response()->json($section , 201);
    }

    // Update a section
    public function updateSection(Request $request , Section $section)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|unique:sections,name,' . $section->id,
            'label' => 'sometimes|required|string',
        ]);
        $section->update($validated);
        return response()->json($section);
    }

    // Delete a section
    public function destroySection(Section $section)
    {
        $section->delete();
        return response()->json(['message' => 'Section deleted']);
    }

    // Assign products to a section
    public function assignProducts(Request $request, Section $section)
    {
        $validated = $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);
        $section->products()->sync($validated['product_ids']);
        return response()->json(['message' => 'Products assigned to section']);
    }

    // Get products for a section
    public function productsBySection(Section $section)
    {
        $products = $section->products()->where('status', 'published')->get();
        return response()->json($products);
    }

}
