<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function categories(){


        $categories =  Category::with('subcategories')->get();
        if ($categories->isEmpty()) {
            return response()->json(['message' => 'No categories available now'], 404);
        }
        return response()->json(['categories' => $categories], 200);

    }
}
