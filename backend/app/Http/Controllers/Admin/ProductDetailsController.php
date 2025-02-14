<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductDetailsController extends Controller {

    public function productDetails($id) {
        $product = Product::with(['productDetails', 'category.subcategories'])->find($id);

        if ($product) {
            $product->productDetails->color = json_decode($product->productDetails->color, true);
            $product->productDetails->size  = json_decode($product->productDetails->size, true);
            return response()->json(['product' => $product], 200);
        }
        return response()->json(['message' => 'Product not found'], 404);
    }

    public function relatedProduct($product_id) {
        // Fetch the current product
        $currentProduct = Product::with('category.subcategories')->find($product_id);

        if (! $currentProduct) {
            return response()->json(['message' => 'Product Not Found'], 401);
        }
        // Fetch related products based on the same category and subcategory
        $relatedProducts = Product::where('subcategory_id', $currentProduct->subcategory_id)
            ->where('id', '!=', $product_id) // Exclude the current product
            ->limit(4)
            ->get();

        // If no related products found, fetch products from the same category
        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::where('category_id', $currentProduct->category_id)
                ->where('id', '!=', $product_id)
                ->limit(4)
                ->get();
        }

        return response()->json(['related_products' => $relatedProducts], 200);

    }
}
