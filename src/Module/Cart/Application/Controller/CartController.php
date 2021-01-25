<?php

namespace App\Module\Cart\Application\Controller;

use App\Module\Cart\Application\Facade\CartFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="add_cart", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addCart(Request $request): JsonResponse
    {
        $cart = CartFacade::instance()->addCart($request->get('userId'));

        return new JsonResponse($cart, Response::HTTP_CREATED);
    }

    /**
     * @Route("/cart/{cartId}", name="get_cart_details", methods={"GET"})
     *
     * @param int $cartId
     * @return JsonResponse
     */
    public function getCartDetails(int $cartId): JsonResponse
    {
        $cartDetails = CartFacade::instance()->getCartDetails($cartId);

        return new JsonResponse($cartDetails, Response::HTTP_CREATED);
    }

    /**
     * @Route("/cart/{cartId}/unit/{productId}", name="add_cart_unit", methods={"POST"})
     *
     * @param int $cartId
     * @param int $productId
     * @return JsonResponse
     */
    public function addCartUnit(int $cartId, int $productId): JsonResponse
    {
        $cartUnit = CartFacade::instance()->addCartUnit($cartId, $productId);

        return new JsonResponse($cartUnit, Response::HTTP_CREATED);
    }

    /**
     * @Route("/cart/{cartId}/unit/{productId}", name="delete_cart_unit", methods={"DELETE"})
     *
     * @param int $cartId
     * @param int $productId
     * @return JsonResponse
     */
    public function deleteCartUnit(int $cartId, int $productId): JsonResponse
    {
        CartFacade::instance()->deleteCartUnit($cartId, $productId);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}

