<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name ?? null,
            'price'      => isset($this->price) ? (float) $this->price : null,
            'attributes' => $this->attributes ?? null, // if attributes is JSON cast
        ];
    }
}
