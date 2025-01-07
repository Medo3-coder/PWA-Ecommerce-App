<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductDetailsController extends Controller {

    public function productDetails($id) {
        $product = Product::with('productDetails')->find($id);

        if ($product) {
            return response()->json(['product' => $product], 200);
        }
        return response()->json(['message' => 'Product not found'], 404);
    }
}
