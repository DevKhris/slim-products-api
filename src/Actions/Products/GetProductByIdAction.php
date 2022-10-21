<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetProductByIdAction extends Action
{
    protected $productRepository;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        /**
         * @var \App\Entities\ProductRepository
         */
        $this->productRepository = $this->entityManager
            ->getRepository(Product::class);
    }

    /**
     * @OA\Get(
     *     path="/v1/products/{id}",
     *     description="Get product by Id",
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
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         description="Identificator"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         description="Name of product"
     *                     ),
     *                     @OA\Property(
     *                         property="slug",
     *                         type="string",
     *                         description="Slug of product"
     *                     ),
     *                     @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         description="Description of product"
     *                     ),
     *                     @OA\Property(
     *                         property="price",
     *                         type="integer",
     *                         description="Price of product"
     *                     ),
     *                     @OA\Property(
     *                         property="stock",
     *                         type="integer",
     *                         description="Stock of product"
     *                     ),
     *                     @OA\Property(
     *                         property="keywords",
     *                         type="string",
     *                         description="Keywords of product"
     *                     ),
     *                     example={
     *                         "id": 1,
     *                         "name": "Prod 1",
     *                         "slug": "prod1",
     *                         "description": "Description Test 1",
     *                         "price": 100,
     *                         "stock": 25,
     *                         "keywords": "prod 1 test"
     *                     }
     *                 )
     *             )
     *         }
     *     ),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     * 
     * Returns welcome message
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request  RequestInterface
     * @param \Psr\Http\Message\ResponseInterface      $response ResponseInterface
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, int $id = null): Response
    {
        /**
         * Product domain
         * 
         * @var \App\Entities\Product
         */
        $product = $this->productRepository->getById($id);

        $response->getBody()->write($product->toJSON());
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
