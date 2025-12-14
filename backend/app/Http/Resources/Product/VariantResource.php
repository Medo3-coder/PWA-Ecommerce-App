<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                => $this->id,
            'attribute_name'    => $this->whenLoaded('productAttribute', fn() => $this->productAttribute->name),
            'value'             => $this->value,
            'additional_price'  => isset($this->additional_price) ? (float) $this->additional_price : null,
            'quantity'          => isset($this->quantity) ? (int) $this->quantity : null,
        ];
    }
}
