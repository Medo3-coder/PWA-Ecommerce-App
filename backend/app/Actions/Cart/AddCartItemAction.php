<?php

namespace App\Actions\Cart;

use App\DTOs\Cart\CartItemData;
use App\Repositories\Contracts\CartRepositoryInterface;

class AddCartItemAction
{
    public function __construct(private CartRepositoryInterface $repo){}

    public function execute(CartItemData $data)
    {
        return $this->repo->addItem($data->toArray());
    }
}
