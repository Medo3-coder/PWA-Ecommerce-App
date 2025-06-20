<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller {

    public function ProductBySearh($query)
    {
        $results = Product::where('title', 'like', "%{$query}%")
                          ->orWhere('brand', 'like', "%{$query}%")
                          ->get();

        if ($results->isEmpty()) {
            return response()->json([
                'message' => 'No products found.',
            ], 404);
        }

        return response()->json($results);
    }

    // Returns all homepage sections with their products
    public function homepageSections()
    {
        // Eager load all sections with up to 8 published products each
        $sections = Section::with(['products' => function($q) {
            $q->where('status', 'published')->limit(8); // Only published products, limit to 8 per section
        }])->get();

        $result = [];
        // Loop through each section
        foreach ($sections as $section) {
            // Use the section's name as the key and assign its products as the value
            $result[$section->name] = $section->products;
        }
        // Return the result as a JSON response
        return response()->json($result);
    }

}
