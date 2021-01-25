<?php

namespace App\Module\Cart\Infrastructure\Repository;

use App\Module\Cart\Domain\Model\Cart\CartId;
use App\Module\Cart\Domain\Model\CartUnit\CartUnit;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitFactoryInterface;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitId;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitRepositoryInterface;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitsCollection;
use App\Module\Cart\Domain\Model\CartUnit\CartUnitsCollectionFactoryInterface;
use App\Module\Cart\Domain\Model\CartUnit\Exception\CartUnitByCartIdAndProductIdNotFoundException;
use App\Module\Cart\Domain\Model\CartUnit\Exception\CartUnitNotFoundException;
use App\Module\Cart\Infrastructure\Entity\CartUnitEntity;
use App\Module\Product\Domain\Model\ProductId;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class DoctrineCartUnitRepository implements CartUnitRepositoryInterface
{
    private EntityManagerInterface $manager;
    private ObjectRepository $doctrineRepository;

    private CartUnitFactoryInterface $cartUnitFactory;
    private CartUnitsCollectionFactoryInterface $cartUnitsCollectionFactory;

    public function __construct(
        EntityManagerInterface $manager,
        CartUnitFactoryInterface $cartUnitFactory,
        CartUnitsCollectionFactoryInterface $cartUnitsCollectionFactory
    )
    {
        $this->manager = $manager;
        $this->doctrineRepository = $this->manager->getRepository(CartUnitEntity::class);

        $this->cartUnitFactory = $cartUnitFactory;
        $this->cartUnitsCollectionFactory = $cartUnitsCollectionFactory;
    }

    public function getCartUnits(CartId $cartId): CartUnitsCollection
    {
        $cartUnitEntityList = $this->doctrineRepository->findBy(['cartId' => $cartId->value()]);

        return $this->cartUnitsCollectionFactory->fromDtoList($cartUnitEntityList);
    }

    public function cartHasUnit(CartId $cartId, ProductId $productId): bool
    {
        try {
            $this->getByCartIdAndProductId($cartId, $productId);
        } catch (CartUnitByCartIdAndProductIdNotFoundException $e) {
            return false;
        }

        return true;
    }

    public function getByCartIdAndProductId(CartId $cartId, ProductId $productId): CartUnit
    {
        $cartUnitEntity = $this->doctrineRepository->findOneBy([
            'cartId' => $cartId->value(),
            'productId' => $productId->value()
        ]);

        if (empty($cartUnitEntity)) {
            throw new CartUnitByCartIdAndProductIdNotFoundException($cartId, $productId);
        }

        return $this->cartUnitFactory->fromDto($cartUnitEntity);
    }

    public function get(CartUnitId $cartUnitId): CartUnit
    {
        $cartUnitEntity = $this->doctrineRepository->find($cartUnitId);

        if (empty($cartUnitEntity)) {
            throw new CartUnitNotFoundException($cartUnitId);
        }

        return $this->cartUnitFactory->fromDto($cartUnitEntity);
    }

    public function cartsHasProduct(ProductId $productId): bool
    {
        $cartUnitEntity = $this->doctrineRepository->findOneBy(['productId' => $productId->value()]);

        return !empty($cartUnitEntity);
    }

    public function save(CartUnit $cartUnit): void
    {
        $this->manager->persist($cartUnit->getDto());
        $this->manager->flush();
    }

    public function remove(CartUnit $cartUnit): void
    {
        $this->manager->remove($cartUnit->getDto());
        $this->manager->flush();
    }
}