<?php

namespace App\Module\User\Domain\Model;

interface UserRepositoryInterface
{
    public function hasUser(UserName $userName): bool;

    public function get(UserId $userId): User;

    public function save(User $user): void;
}