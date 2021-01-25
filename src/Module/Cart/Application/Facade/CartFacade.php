<?php

namespace App\Module\Cart\Application\Facade;

use App\Module\Cart\Application\UseCase\Cart\AddCart\AddCartRequest;
use App\Module\Cart\Application\UseCase\Cart\GetCartDetails\GetCartDetailsRequest;
use App\Module\Cart\Application\UseCase\CartUnit\AddCartUnit\AddCartUnitRequest;
use App\Module\Cart\Application\UseCase\CartUnit\CartsHasProduct\CartsHasProductRequest;
use App\Module\Cart\Application\UseCase\CartUnit\DeleteCartUnit\DeleteCartUnitRequest;
use App\Module\Cart\Domain\Model\Cart\Cart;
use App\Module\Cart\Domain\Model\CartDetails\CartDetails;
use App\Module\Cart\Domain\Model\CartUnit\CartUnit;
use Symfony\Component\HttpKernel\KernelInterface;

final class CartFacade
{
    private KernelInterface $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public static function instance(): self
    {
        global $kernel;

        return new self($kernel);
    }

    public function addCart(int $userId): Cart
    {
        $request = new AddCartRequest($userId);

        return $this->kernel->getContainer()->get('sdrae.cart.use_case.add_cart')->handle($request);
    }

    public function getCartDetails(int $cartId): CartDetails
    {
        $request = new GetCartDetailsRequest($cartId);

        return $this->kernel->getContainer()->get('sdrae.cart.use_case.get_cart_details')->handle($request);
    }

    public function addCartUnit(int $cartId, int $productId): CartUnit
    {
        $request = new AddCartUnitRequest($cartId, $productId);

        $service = $this->kernel->getContainer()->get('sdrae.cart_unit.use_case.add_cart_unit');

        return $service->handle($request);
    }

    public function deleteCartUnit(int $cartId, int $productId): void
    {
        $request = new DeleteCartUnitRequest($cartId, $productId);

        $service = $this->kernel->getContainer()->get('sdrae.cart_unit.use_case.delete_cart_unit');

        $service->handle($request);
    }

    public function cartsHasProduct(int $productId): bool
    {
        $request = new CartsHasProductRequest($productId);

        $service = $this->kernel->getContainer()->get('sdrae.cart_unit.use_case.carts_has_product');

        return $service->handle($request);
    }
}