<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreRequest;
use App\Http\Requests\Admin\Categories\UpdateOrderRequest;
use App\Http\Requests\Admin\Categories\UpdateRequest;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */

    public function index()
    {
        $categories = ProductCategory::with('children')
        // ->whereNull('parent_id')
            ->orderBy('order')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Store a newly created category.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['name']);

        $category = ProductCategory::create($validated);

        return response()->json([
            'message'  => 'Category created successfully',
            'category' => $category,
        ], 201);
    }

    /**
     * Display the specified category.
     */
    public function create()
    {
        $categories = ProductCategory::whereNULL('parent_id')->get();
        return view('admin.categories.create', compact('categories'));
    }

    public function edit($id)
    {
        $category   = ProductCategory::findOrFail($id);
        $categories = ProductCategory::where('id', '!=', $id)
            ->whereNull('parent_id')
            ->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified category.
     */
    public function update(UpdateRequest $request, ProductCategory $category)
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return response()->json([
            'message'  => 'Category updated successfully',
            'category' => $category,
        ], 200);
    }

    /**
     * Remove the specified category.
     */
    public function destroy(ProductCategory $category)
    {
        // Check if category has children
        if ($category->children()->exists()) {
            return response()->json([
                'message' => 'Cannot delete category with subcategories. Please delete subcategories first.',
            ], 422);
        }

        // Check if category has products
        if ($category->products()->exists()) {
            return response()->json([
                'message' => 'Cannot delete category with associated products. Please remove products first.',
            ], 422);
        }

        // Delete category image if exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        Cache::forget('categories.all');

        return response()->json([
            'message' => 'Category deleted successfully',
        ], 200);
    }

    /**
     * Update category order.
     */
    public function updateOrder(UpdateOrderRequest $request)
    {
        $validated = $request->validated();

        foreach ($validated['categories'] as $item) {
            ProductCategory::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        Cache::forget('categories.all');

        return response()->json([
            'message' => 'Category order updated successfully',
        ], 200);
    }


    public function show(ProductCategory $category)
    {
        return view('admin.categories.show', compact('category'));
    }
}
