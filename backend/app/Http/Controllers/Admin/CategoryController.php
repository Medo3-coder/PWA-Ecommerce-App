<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function catagories(){

        $categories = Category::with('subcategories')->get();

        return response()->json($categories , 200);

    }
}
