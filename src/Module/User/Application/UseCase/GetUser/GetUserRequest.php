<?php

namespace App\Module\User\Application\UseCase\GetUser;

use App\Module\User\Domain\Model\UserId;

final class GetUserRequest
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