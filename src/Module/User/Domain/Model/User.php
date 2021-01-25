<?php

namespace App\Module\User\Domain\Model;

final class User
{
    private UserDtoInterface $dto;

    public function __construct($dto)
    {
        $this->dto = $dto;
    }

    public function getDto(): UserDtoInterface
    {
        return $this->dto;
    }

    public function id(): UserId
    {
        return $this->getDto()->getId();
    }

    public function title(): UserName
    {
        return $this->getDto()->getName();
    }
}