<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Repositories\Contracts\API\ApiProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(private ApiProductRepositoryInterface $productRepository)
    {}

    /**
     * Search products by title, brand, or description
     */

    public function ProductBySearh($query)
    {
        $results = $this->productRepository->search($query, 20);

        if ($results->isEmpty()) {
            return response()->json(['message' => 'No products found'], 404);
        }
        return response()->json(['status' => 'success', 'data' => ['products' => $results]]);
    }

    /**
     * Get products by remark/tag
     */
    public function productsByRemark($remark)
    {
        $results = $this->productRepository->getByRemark($remark, 20);

        if ($results->isEmpty()) {
            return response()->json(['message' => 'No products found for this remark'], 404);
        }
        return response()->json(['status' => 'success', 'data' => ['products' => $results]]);
    }

    /**
     * Get products by category
     */
    public function getProductByCategory($slug)
    {
        $results = $this->productRepository->getByCategory($slug, 12);
        if (! $results) {
            return response()->json(['message' => 'Category not found or has no published products'], 404);
        }
        return response()->json(['status' => 'success', 'data' => ['products' => $results]]);
    }

    // Returns all homepage sections with their products
    public function homepageSections()
    {
        $result = $this->productRepository->getHomepageSections();
        if (! $result) {
            return response()->json(['message' => 'No homepage sections found'], 404);
        }
        return response()->json(['status' => 'success', 'data' => ['sections' => $result]]);
    }
    /**
     * Get all published products
     */
    public function getAllPublished(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $results = $this->productRepository->getAllPublished($perPage);

        if ($results->isEmpty()) {
            return response()->json(['message' => 'No published products found'], 404);
        }
        return ProductResource::collection($results);
    }

    /**
     * Get single product by ID
     */
    public function getProductById($id)
    {
        $product = $this->productRepository->getById($id);

        if (! $product) {   // still here we need to check why reviews not loaded 
            return response()->json(['message' => 'Product not found'], 404);
        }
        // return response()->json(['status' => 'success', 'data' => ['product' => $product]]);
        return new ProductResource($product);
    }

    public function RelatedProducts($productId)
    {
        $results = $this->productRepository->getRelatedProducts($productId, 6);
        if ($results->isEmpty()) {
            return response()->json(['message' => 'No related products found'], 404);
        }
        return response()->json(['status' => 'success', 'data' => ['products' => $results]]);
    }

    public function LastestProducts()
    {
        $results = $this->productRepository->getLatest(10);
        if ($results->isEmpty()) {
            return response()->json(['message' => 'No latest products found'], 404);
        }
        return response()->json(['status' => 'success', 'data' => ['products' => $results]]);
    }

    public function productBySectionName($sectionName)
    {
        $results = $this->productRepository->getBySectionName($sectionName, 8);
        if ($results->isEmpty()) {
            return response()->json(['message' => 'No products found for this section'], 404);
        }
        return response()->json(['status' => 'success', 'data' => ['products' => $results]]);
    }

}
