<?php

namespace App\Actions;

use App\Actions\Action;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * @OA\Info(
 *     title="Grow Swagger",
 *     version="0.1",
 *     contact={
 *     "email": "joaquin.cejas@avalith.net"
 *     },
 *     description="Swagger Grow Documentation"
 * ),
 * @OA\Server(
 *   url="http://localhost:8001",
 *   description="Developer"
 * ),
 * @OA\Tag(
 *   name="Products",
 *   description="Search, Create, Update and Delete Products"
 * ),
 * @OA\Tag(
 *   name="Welcome",
 *   description="Index Tag"
 * )
 */
final class WelcomeAction extends Action
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    /**
     * @OA\Get(
     *     path="/",
     *     description="Index",
     *     tags={"Welcome"},
     *     @OA\Response(
     *         response="200",
     *         description="Always reply 200 OK",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="text/html",
     *                 @OA\Schema(
     *                     example="Welcome to Products API"
     *                 )
     *             )
     *         }
     *     )
     * )
     * 
     * Returns welcome message
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request  RequestInterface
     * @param \Psr\Http\Message\ResponseInterface      $response ResponseInterface
     * 
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, $args = []): Response
    {
        $response->getBody()->write("Welcome to Products API");

        return $response;
    }
}
