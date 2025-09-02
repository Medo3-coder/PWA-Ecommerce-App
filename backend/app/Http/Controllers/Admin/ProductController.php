<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreRequest;
use App\Http\Requests\Admin\Products\UpdateRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

final class ProductController extends Controller
{
    public function __construct(private ProductService $service)
    {
    }

    public function index(Request $request)
    {
        $products = $this->service->list($request->only(['q', 'category', 'status', 'sort', 'dir']));
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        [$categories, $tags, $attributes, $sections] = $this->service->formData();
        return view('admin.products.create', compact('categories', 'tags', 'attributes', 'sections'));
    }

    public function store(StoreRequest $request)
    {
        $product = $this->service->create($request->validated());
        return response()->json(['product' => $product, 'message' => 'Product created successfully']);
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $this->service->update($product, $request->validated());
        return response()->json(['message' => 'Product updated successfully']);
    }

    public function destroy(Product $product)
    {
        $this->service->delete($product);
        return response()->json(['message' => 'Product deleted successfully']);
    }

    public function toggleStatus(Product $product)
    {
        $this->service->toggleStatus($product);
        return response()->json(['message' => 'Product status updated successfully']);
    }

    public function bulkAction(Request $request)
    {
        $data = $request->validate([
            'ids'    => 'required|array',
            'ids.*'  => 'integer|exists:products,id',
            'action' => 'required|string|in:delete,publish,unpublish',
        ]);
        $this->service->bulkAction($data);
        return back()->with('success', 'Bulk action applied.');
    }

}
