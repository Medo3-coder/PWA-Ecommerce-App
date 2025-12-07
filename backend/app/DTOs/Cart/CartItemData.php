<?php

namespace App\DTOs\Cart;

class CartItemData
{
    public function __construct(
        public ?int $id,
        public ?int $userId,
        public ?string $sessionId,
        public int $productId,
        public int $quantity,
        public ?array $meta,
        public float $price,
    ) {}


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->userId,
            'session_id' => $this->sessionId,
            'product_id' => $this->productId,
            'quantity' => $this->quantity,
            'meta' => $this->meta,
            'price' => $this->price,
        ];
    }   
}
