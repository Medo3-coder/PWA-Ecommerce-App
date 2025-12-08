<?php

use App\Cart\Actions\AddCartItemAction;
use App\Cart\Actions\ClearCartAction;
use App\Domain\Cart\Actions\RemoveCartItemAction;
use App\Domain\Cart\Actions\UpdateCartItemAction;
use App\DTOs\Cart\CartItemData;
use App\Repositories\Contracts\CartRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function __construct(
        private CartRepositoryInterface $repo ,
        private AddCartItemAction $addAcation,
        private UpdateCartItemAction $updateAction,
        private RemoveCartItemAction $removeAction,
        private ClearCartAction $clearAction,
    ){}

    public function getCartItems(?int $userId , ?string $sessionId)
    {
        return $this->repo->getItems($userId , $sessionId);
    }

    public function addItem(CartItemData $data)
    {
        // Example: check stock, calculate price snapshot
        // $product = Product::findOrFail($data->product_id);
        // if ($product->stock < $data->quantity) throw new \Exception('Not enough stock');
        // $data->price = $product->price;
        return $this->addAcation->execute($data);
    }

    public function updateItem(int $id , array $payload)
    {
        return DB::transaction(function () use ($id , $payload) {
            return $this->updateAction->execute($id , $payload);
        });
    }

    public function removeItem(int $id): bool
    {
        return $this->removeAction->execute($id);
    }

       public function clearCart(?int $userId, ?string $sessionId): int
    {
        return $this->clearAction->execute($userId, $sessionId);
    }
}
