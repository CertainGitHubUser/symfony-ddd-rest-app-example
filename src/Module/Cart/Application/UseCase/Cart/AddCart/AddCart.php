<?php

namespace App\Module\Cart\Application\UseCase\Cart\AddCart;

use App\Module\Cart\Domain\Model\Cart\Cart;
use App\Module\Cart\Domain\Model\Cart\CartFactoryInterface;
use App\Module\Cart\Domain\Model\Cart\CartRepositoryInterface;
use App\Module\Cart\Domain\Model\Cart\Exception\UserHasCartException;
use App\Module\User\Application\Facade\UserFacade;

final class AddCart
{
    private CartRepositoryInterface $cartRepository;

    private CartFactoryInterface $cartFactory;

    public function __construct(CartRepositoryInterface $cartRepository, CartFactoryInterface $cartFactory)
    {
        $this->cartRepository = $cartRepository;
        $this->cartFactory = $cartFactory;
    }

    public function handle(AddCartRequest $request): Cart
    {
        $this->assertIsValid($request);

        $cart = $this->cartFactory->fromArgs($request->getUserId());
        $this->cartRepository->save($cart);

        return $this->cartRepository->getByOwner($request->getUserId());
    }

    private function assertIsValid(AddCartRequest $request): void
    {
        if ($this->cartRepository->userHasCart($request->getUserId())) {
            throw new UserHasCartException($request->getUserId());
        }

        UserFacade::instance()->getUser($request->getUserId()->value());
    }
}