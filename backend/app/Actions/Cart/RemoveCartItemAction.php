<?php

namespace App\Domain\Cart\Actions;

use App\Repositories\Contracts\CartRepositoryInterface;

class RemoveCartItemAction
{
    public function __construct(private CartRepositoryInterface $repo){}

    public function execute(int $id)
    {
        return $this->repo->removeItem($id);
    }

}


