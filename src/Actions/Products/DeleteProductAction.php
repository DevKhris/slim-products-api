<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use App\Entities\ProductRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class DeleteProductAction extends Action
{
    protected $productRepository;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        /**
         * @var ProductRepository
         */
        $this->productRepository = $this->entityManager
            ->getRepository(Product::class);
    }

    /**
     * @OA\Delete(
     *     path="/v1/deleteProduct/{id}",
     *     description="Delete product by Id",
     *     tags={"Products"},
     *     @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="text/html",
     *                 @OA\Schema(
     *                     example="Product deleted succesfully"
     *                 )
     *             )
     *         }
     *     ),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function __invoke(Request $request, Response $response, $id): Response
    {
        /**
         * Product domain
         * 
         * @var \App\Entities\Product
         */
        $this->productRepository->destroy($id);

        $response->getBody()->write("Product deleted succesfully");

        return $response;
    }
}
