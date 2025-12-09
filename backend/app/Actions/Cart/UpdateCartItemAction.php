<?php

namespace App\Actions\Cart;

use App\Repositories\Contracts\CartRepositoryInterface;

class UpdateCartItemAction
{
    public function __construct(private CartRepositoryInterface $repo){}

    public function execute(int $id , array $data)
    {
        return $this->repo->updateItem($id, $data);
    }
}
