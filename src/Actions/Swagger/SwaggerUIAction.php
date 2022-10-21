<?php
namespace App\Actions\Swagger;

use App\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class SwaggerUIAction extends Action
{
    public function __invoke(Request $request, Response $response): Response
    {
        $view = Twig::fromRequest($request);
        $params = [];
        return $view->render($response, "swaggerUI.php", $params);
    }
}

?>