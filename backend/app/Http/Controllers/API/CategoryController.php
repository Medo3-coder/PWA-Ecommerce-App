<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\API\ApiCategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private ApiCategoryRepositoryInterface $categoryRepository)
    {
    }

    /**
     * Get all active categories with their children.
     */
    public function index()
    {
        $categories = $this->categoryRepository->index();

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
        $category = $this->categoryRepository->show($slug);

        if (!$category) {
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
        $result = $this->categoryRepository->products($slug);

        if (!$result) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Category Not Found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $result,
        ]);
    }

    /**
     * Get category breadcrumb.
     */
    public function breadcrumb($slug)
    {
        $breadcrumb = $this->categoryRepository->breadcrumb($slug);

        if (!$breadcrumb) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Category not found',
            ], 404);
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
            ], 400);
        }

        $categories = $this->categoryRepository->search($query);

        return response()->json([
            'status' => 'success',
            'data'   => [
                'categories' => $categories,
            ],
        ]);
    }
}

