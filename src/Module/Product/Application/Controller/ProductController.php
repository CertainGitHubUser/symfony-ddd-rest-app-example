<?php

namespace App\Module\Product\Application\Controller;

use App\Module\Common\Application\Response\JsonPaginationResponse;
use App\Module\Product\Application\Facade\ProductFacade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="add_product", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addProduct(Request $request): JsonResponse
    {
        $product = ProductFacade::instance()->addProduct($request->get('price'), $request->get('title'));

        return new JsonResponse($product, Response::HTTP_CREATED);
    }

    /**
     * @Route("/products/{productId}", name="update_product", methods={"PUT"})
     *
     * @param Request $request
     * @param int $productId
     * @return JsonResponse
     */
    public function updateProduct(Request $request, int $productId): JsonResponse
    {
        $product = ProductFacade::instance()->updateProduct($productId, $request->get('price'), $request->get('title'));

        return new JsonResponse($product, Response::HTTP_OK);
    }

    /**
     * @Route("/products/{productId}", name="delete_product", methods={"DELETE"})
     *
     * @param int $productId
     * @return JsonResponse
     */
    public function deleteProduct(int $productId): JsonResponse
    {
        ProductFacade::instance()->deleteProduct($productId);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/products/list", name="get_products_paginated_collection", methods={"POST"})
     *
     * @param Request $request
     * @return JsonPaginationResponse|JsonResponse
     */
    public function getProductsPaginatedCollection(Request $request): JsonPaginationResponse
    {
        $collection = ProductFacade::instance()->getProductsPaginatedCollection(
            $request->get('limit'),
            $request->get('offset')
        );

        return new JsonPaginationResponse($collection, Response::HTTP_OK);
    }
}