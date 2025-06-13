<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     * Get all active categories with their children.
     */

    public function index()
    {
        $categories = Cache::remember('api.categories.all', 3600, function () {
            return ProductCategory::with(['children' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('order');
            }])->whereNull('parent_id')
                ->where('is_active', true)
                ->get();
        });

        return response()->json([
            'status' => 'success',
            'data'   => [
                'categories' => $categories,
            ],
        ]);
    }

    /**
     * Get a specific category with its children and parent.
     */

    public function show($slug)
    {
        $category = Cache::remember('api.category', 3600, function () use ($slug) {
            return ProductCategory::with(['children' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('order');
            }, 'parent'])
                ->where('slug', $slug)
                ->where('is_active', true)
                ->first();
        });

        if (! $category) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Category not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => [
                'category' => $category,
            ],
        ]);
    }

    /**
     * Get all products in a category.
     */

    public function products($slug)
    {
        $category = ProductCategory::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (! $category) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Category Not Found',
            ], 404);
        }

        $products = $category->products()
            ->with(['category'])
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

            // dd($products);

        return response()->json([
            'status' => 'success',
            'data'   => [
                'category' => $category,
                'products' => $products,
            ],
        ]);
    }

    /**
     * Get category breadcrumb.
     */

    public function breadcrumb($slug)
    {
        $category = ProductCategory::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (! $category) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Category not found',
            ], 404);
        }

        $breadcrumb = collect([$category]);
        $current    = $category;

        while ($current->parent) {
            $current = $current->parent;
            $breadcrumb->prepend($current);
        }

        return response()->json([
            'status' => 'success',
            'data'   => [
                'breadcrumb' => $breadcrumb,
            ],
        ]);
    }

    /**
     * Search categories.
     */

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        if (empty($query)) {
            return response()->json([
                'status'  => 'error',
                'message' => 'search query required',
            ], 404);
        }

        $categories = ProductCategory::where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            })
            ->with('parent')
            ->orderBy('name')
            ->limit(10)
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => [
                'categories' => $categories,
            ],
        ]);
    }

}
