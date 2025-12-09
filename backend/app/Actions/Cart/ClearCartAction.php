<?php

namespace App\Actions\Cart;

use App\Repositories\Contracts\CartRepositoryInterface;

class ClearCartAction
{
    public function __construct(private CartRepositoryInterface $repo){}

    public function execute(?int $userId, ?string $sessionId)
    {
        return $this->repo->clear($userId, $sessionId);
    }
}
