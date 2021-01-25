<?php

namespace App\Module\User\Application\UseCase\AddUser;

use App\Module\User\Domain\Model\UserName;

final class AddUserRequest
{
    private UserName $title;

    public function __construct(string $title)
    {
        $this->title = new UserName($title);
    }

    public function getName(): UserName
    {
        return $this->title;
    }
}