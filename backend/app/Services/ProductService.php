<?php
namespace App\Services;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use App\Models\Section;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

final class ProductService
{
    public function list(array $filters, int $perPage = 15)
    {
        $query = Product::query()->with(['category', 'tags', 'sections'])->latest();

        if ($q = Arr::get($filters, 'q')) {
            $query->where('name', 'like', "%{$q}%");
        }
        if ($category = Arr::get($filters, 'category')) {
            $query->where('product_category_id', $category);
        }
        if ($status = Arr::get($filters, 'status')) {
            $query->where('status', $status);
        }
        if ($sort = Arr::get($filters, 'sort')) {
            $dir = Arr::get($filters, 'dir', 'asc');
            $query->orderBy($sort, $dir);
        }
        return $query->paginate($perPage)->withQueryString();
    }

    public function formData(): array
    {
        return [
            ProductCategory::orderBy('name')->get(),
            ProductTag::orderBy('name')->get(),
            ProductAttribute::orderBy('name')->get(),
            Section::orderBy('label')->get(),
        ];
    }

    public function create(array $data): Product
    {
        return DB::transaction(function () use ($data) {
            $product = Product::create(Arr::only($data, [
                'product_category_id', 'name', 'description', 'price', 'quantity', 'product_status_id', 'status',
            ]));
            $this->syncRelations($product, $data);
            return $product;
        });
    }

    public function update(Product $product, array $data): void
    {
        DB::transaction(function () use ($product, $data) {
            $product->update(Arr::only($data, [
                'product_category_id', 'name', 'description', 'price', 'quantity', 'product_status_id', 'status',
            ]));
            $this->syncRelations($product, $data);
        });
    }

    public function delete(Product $product): void
    {
        DB::transaction(function () use ($product) {
            $product->tags()->detach();
            $product->sections()->detach();
            $product->variants()->delete();
            $product->delete();
        });
    }

    public function toggleStatus(Product $product): void
    {
        $product->update(['status' => $product->status === 'published' ? 'draft' : 'published']);
    }

    public function bulkAction(array $data): void
    {
        $ids    = $data['ids'];
        $action = $data['action'];
        Product::whereIn('id', $ids)->chunkById(200, function ($chunk) use ($action) {
            foreach ($chunk as $product) {
                match ($action) {
                    'delete' => $this->delete($product),
                    'publish'   => $product->update(['status' => 'published']),
                    'unpublish' => $product->update(['status' => 'draft']),
                };
            }
        });
    }
}
