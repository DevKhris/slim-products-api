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
