<?php

namespace App\Repositories\Contracts;

interface CartRepositoryInterface
{
    public function forUserOrSession(?int $userId, ?string $sessionId);
    public function getItems(?int $userId, ?string $sessionId);
    public function addItem(array $data);
    public function updateItem(int $id, array $data);
    public function removeItem(int $id);
    public function clear(?int $userId, ?string $sessionId);
    public function find(int $id);
}
