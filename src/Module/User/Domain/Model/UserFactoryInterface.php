<?php

namespace App\Module\User\Domain\Model;

interface UserFactoryInterface
{
    public function fromArgs(UserName $name): User;

    public function fromDto(UserDtoInterface $dto): User;
}