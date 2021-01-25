<?php

namespace App\Module\User\Domain\Model;

interface UserDtoInterface
{
    public function getId(): UserId;

    public function setId(int $id): void;

    public function getName(): UserName;

    public function setName(string $name): void;
}