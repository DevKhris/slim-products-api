<?php


namespace App\Actions\Products;

use App\Actions\Action;
use App\Entities\Product;
use App\Entities\ProductRepository;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UpdateProductAction extends Action
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
     * @OA\Put(
     *     path="/v1/updateProduct/{id}",
     *     description="Update product",
     *     tags={"Products"},
     *     @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
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
     *                         "name": "New Name",
     *                         "slug": "new-name-prod",
     *                         "description": "This is the updated description",
     *                         "price": 100,
     *                         "stock": 25,
     *                         "keywords": "new name product"
     *                     }
     *                 )
     *             )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                     example="Product created succesfully"
     *                 )
     *             )
     *         }
     *     ),
     *     @OA\Response(response=500, description="Internal Server Error")
     * )
     */
    public function __invoke(Request $request, Response $response, $id): Response
    {
        $data = $request->getParsedBody();

        $this->productRepository->update($id, $data);

        $response->getBody()->write("Product update succesfully");

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}
