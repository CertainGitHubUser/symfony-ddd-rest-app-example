<?php

namespace App\Module\User\Infrastructure\Factory;

use App\Module\User\Domain\Model\User;
use App\Module\User\Domain\Model\UserDtoInterface;
use App\Module\User\Domain\Model\UserFactoryInterface;
use App\Module\User\Domain\Model\UserName;
use App\Module\User\Infrastructure\Entity\UserEntity;

final class UserFactory implements UserFactoryInterface
{
    public function fromArgs(UserName $name): User
    {
        $entity = new UserEntity();
        $entity->setName($name->value());

        return $this->fromDto($entity);
    }

    public function fromDto(UserDtoInterface $dto): User
    {
        return new User($dto);
    }
}
