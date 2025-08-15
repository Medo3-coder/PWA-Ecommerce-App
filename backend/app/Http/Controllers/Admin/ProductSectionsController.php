<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductSectionsController extends Controller
{
    // Admin Panel Methods

    // List all sections
    public function index()
    {
        $sections = Section::withCount('products')->get();
        return view('admin.sections.index', compact('sections'));
    }

    // Show create form
    public function create()
    {
        return view('admin.sections.create');
    }

    // Store new section
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:sections,name',
            'label' => 'required|string',
        ]);

        Section::create($validated);
        Cache::tags(['sections'])->flush();

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section created successfully.');
    }

    // Show edit form
    public function edit(Section $section)
    {
        $section->load('products');
        $allProducts = Product::where('status', 'published')->get();
        return view('admin.sections.edit', compact('section', 'allProducts'));
    }

    // Update section
    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:sections,name,' . $section->id,
            'label' => 'required|string',
        ]);

        $section->update($validated);
        Cache::tags(['sections'])->flush();

        return redirect()->route('admin.sections.index')
            ->with('success', 'Section updated successfully.');
    }

    // Delete section
    public function destroy(Section $section)
    {
        $section->delete();
        Cache::tags(['sections'])->flush();

        return response()->json(['message' => 'Section deleted successfully']);
    }

    // Show section details and manage products
    public function show(Section $section)
    {
        $section->load('products');
        $allProducts = Product::where('status', 'published')->get();
        return view('admin.sections.show', compact('section', 'allProducts'));
    }

    // Assign products to section
    public function assignProducts(Request $request, Section $section)
    {
        $validated = $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        $section->products()->sync($validated['product_ids']);
        Cache::tags(['sections', 'products'])->flush();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Products assigned to section']);
        }

        return redirect()->route('admin.sections.show', $section)
            ->with('success', 'Products assigned successfully.');
    }

    // API Methods (keeping existing ones)

    // List all sections (API)
    public function sections()
    {
        return response()->json(Section::all());
    }

    // Create a new section (API)
    public function storeSection(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:sections,name',
            'label' => 'required|string',
        ]);
        $section = Section::create($validated);
        Cache::tags(['sections'])->flush();
        return response()->json($section , 201);
    }

    // Update a section (API)
    public function updateSection(Request $request , Section $section)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|unique:sections,name,' . $section->id,
            'label' => 'sometimes|required|string',
        ]);
        $section->update($validated);
        Cache::tags(['sections'])->flush();
        return response()->json($section);
    }

    // Delete a section (API)
    public function destroySection(Section $section)
    {
        $section->delete();
        Cache::tags(['sections'])->flush();
        return response()->json(['message' => 'Section deleted']);
    }

    // Get products for a section (API)
    public function productsBySection(Section $section)
    {
        $products = $section->products()->where('status', 'published')->get();
        return response()->json($products);
    }

    // Get products for a section
    // public function productsBySection(Section $section)
    // {
    //     $products = $section->products()->where('status', 'published')->get();
    //     return response()->json($products);
    // }

}
