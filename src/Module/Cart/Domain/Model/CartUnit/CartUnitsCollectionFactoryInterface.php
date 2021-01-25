<?php

namespace App\Module\Cart\Domain\Model\CartUnit;

interface CartUnitsCollectionFactoryInterface
{
    public function fromDtoList(array $cartUnitEntityList): CartUnitsCollection;
}