<?php

namespace App\Module\Cart\Application\UseCase\Cart\AddCart;

use App\Module\User\Domain\Model\UserId;

final class AddCartRequest
{
    private UserId $userId;

    public function __construct(int $userId)
    {
        $this->userId = new UserId($userId);
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }
}