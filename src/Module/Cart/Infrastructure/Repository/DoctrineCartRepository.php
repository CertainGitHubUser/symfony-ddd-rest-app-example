<?php

namespace App\Module\Cart\Infrastructure\Repository;

use App\Module\Cart\Domain\Model\Cart\Cart;
use App\Module\Cart\Domain\Model\Cart\CartFactoryInterface;
use App\Module\Cart\Domain\Model\Cart\CartId;
use App\Module\Cart\Domain\Model\Cart\CartRepositoryInterface;
use App\Module\Cart\Domain\Model\Cart\Exception\CartByUserNotFoundException;
use App\Module\Cart\Domain\Model\Cart\Exception\CartNotFoundException;
use App\Module\Cart\Infrastructure\Entity\CartEntity;
use App\Module\User\Domain\Model\UserId;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class DoctrineCartRepository implements CartRepositoryInterface
{
    private EntityManagerInterface $manager;
    private ObjectRepository $doctrineRepository;

    private CartFactoryInterface $cartFactory;

    public function __construct(EntityManagerInterface $manager, CartFactoryInterface $cartFactory)
    {
        $this->manager = $manager;
        $this->doctrineRepository = $this->manager->getRepository(CartEntity::class);

        $this->cartFactory = $cartFactory;
    }

    public function get(CartId $cartId): Cart
    {
        $cartEntity = $this->doctrineRepository->find($cartId->value());

        if (empty($cartEntity)) {
            throw new CartNotFoundException($cartId);
        }

        return $this->cartFactory->fromDto($cartEntity);
    }

    public function getByOwner(UserId $userId): Cart
    {
        $cartEntity = $this->doctrineRepository->findOneBy(['ownerId' => $userId->value()]);

        if (empty($cartEntity)) {
            throw new CartByUserNotFoundException($userId);
        }

        return $this->cartFactory->fromDto($cartEntity);
    }

    public function userHasCart(UserId $userId): bool
    {
        try {
            $this->getByOwner($userId);
        } catch (CartByUserNotFoundException $e) {
            return false;
        }

        return true;
    }

    public function save(Cart $cart): void
    {
        $this->manager->persist($cart->getDto());
        $this->manager->flush();
    }
}