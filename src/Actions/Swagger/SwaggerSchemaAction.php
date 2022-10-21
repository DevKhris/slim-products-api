<?php
namespace App\Actions\Swagger;

use App\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class SwaggerSchemaAction extends Action
{
    public function __invoke(Request $request, Response $response): Response
    {
        $request->withHeader('Content-Type', 'application/x-yaml');
        $response->getBody()->write(file_get_contents(__DIR__ . '/../../../openapi.yaml'));
        return $response;
    }
}

?>