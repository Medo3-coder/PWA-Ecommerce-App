<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function getProductsByRemark(Request $request) {
        $products = Product::where('remark', $request->remark)->limit(8)->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found for the given remark'], 404);
        }

        return response()->json($products);
    }

    public function getProductByCategory(Request $request) {
        $products = Product::where('category', $request->category)->get();
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found for the given category'] , 404);
        }

        return response()->json($products);
    }

    public function getProductBySubCategory(Request $request){
        $products = Product::where('category' , $request->category)->where('subcategory' , $request->subcategory)->get();
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found for the given category'] , 404);
        }
        return response()->json($products);

    }
}
