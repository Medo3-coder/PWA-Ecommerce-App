<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function getProductByRemark(Request $request) {
        $products = Product::where('remark', $request->remark)->limit(8)->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found for the given remark'], 404);
        }

        return response()->json($products, 200);
    }

    public function getProductByCategory(Request $request) {
        $category = Category::where('slug', $request->slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();

        if ($products->isEmpty()) {
            // Return a success response with an empty array and a message
            return response()->json([
                'message'  => 'No products found for the given category',
                'products' => [],
            ], 200);
        }

        return response()->json(['products' => $products], 200);
    }

    public function getProductBySubCategory(Request $request, $category_slug, $subcategory_slug) {

        $category    = Category::where('slug', $category_slug)->first();
        $subCategory = Subcategory::where('slug', $subcategory_slug)->first();

        if (!$category || !$subCategory) {
            return response()->json(['message' => 'Category or Subcategory not found'], 404);
        }

        $products = Product::where('category_id', $category->id)
            ->where('subcategory_id', $subCategory->id)
            ->get();

        if ($products->isEmpty()) {
            return response()->json([
                'message'  => 'No products found for the this subcategory',
                'products' => [],
            ], 200);
        }
        return response()->json(['products' => $products], 200);

    }
}
