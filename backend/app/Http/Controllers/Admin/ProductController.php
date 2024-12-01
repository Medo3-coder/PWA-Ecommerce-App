<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller {
    public function getProductsByRemark($remark) {
        $products = Product::where('remark', $remark)->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found for the given remark'], 404);
        }

        return response()->json($products);
    }
}
