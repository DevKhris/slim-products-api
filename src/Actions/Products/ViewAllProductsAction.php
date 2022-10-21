<?php

namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class ViewAllProductsAction extends Action
{
    /**
     * Product repository
     *
     * @var \App\Entities\ProductRepository
     */
    protected $productRepository;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->productRepository = $this->entityManager
            ->getRepository(Product::class);
    }

    /**
     * 
     * @OA\Get(
     *     path="/v1/products",
     *     description="Get all products",
     *     tags={"Products"},
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
     *                         {
     *                             "id": 1,
     *                             "name": "Prod 1",
     *                             "slug": "prod1",
     *                             "description": "Description Test 1",
     *                             "price": 100,
     *                             "stock": 25,
     *                             "keywords": "prod 1 test"
     *                         },
     *                         {
     *                             "id": 2,
     *                             "name": "Prod 2",
     *                             "slug": "prod2",
     *                             "description": "Description Test 2",
     *                             "price": 150,
     *                             "stock": 33,
     *                             "keywords": "prod 2 test"
     *                         }
     *                     }
     *                 )
     *             )
     *         }
     *     )
     * )
     * 
     * Fetch all products and returns response
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request  RequestInterface
     * @param \Psr\Http\Message\ResponseInterface      $response ResponseInterface
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response): Response
    {
        $products = $this->productRepository->fetchAll();

        $response->getBody()->write(json_encode($products));

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
