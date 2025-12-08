<?php
namespace App\Http\Resources\Product;

use App\Http\Resources\Product\CategoryResource;
use App\Http\Resources\Product\SectionResource;
use App\Http\Resources\Product\TagResource;
use App\Http\Resources\Product\VariantResource;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => $this->price !== null ? (float) $this->price : null,
            'quantity'    => $this->quantity !== null ? (int) $this->quantity : null,
            'status'      => $this->status,
             // Use single resource for the category (when loaded)
            'category'    => new CategoryResource($this->whenLoaded('category')),

            'image'       => $this->when(
                isset($this->image_url) || method_exists($this, 'getFirstMediaUrl'),
                fn() => $this->image_url ?? $this->getFirstMediaUrl('cover')
            ),
             // collections use the corresponding resource collections
            'tags'        => TagResource::collection($this->whenLoaded('tags')),
            'variants'    => VariantResource::collection($this->whenLoaded('variants')),
            'sections'    => SectionResource::collection($this->whenLoaded('sections')),
            'created_at'  => $this->created_at ? $this->created_at->toDateTimeString() : null,
            'updated_at'  => $this->updated_at ? $this->updated_at->toDateTimeString() : null,
        ];
    }
}
