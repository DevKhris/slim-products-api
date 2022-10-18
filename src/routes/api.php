<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->get(
        '/',
        \App\Actions\WelcomeAction::class
    );

    $app->group(
        '/v1',
        function (RouteCollectorProxy $group) {

            $group->group(
                '/products',
                function (RouteCollectorProxy $group) {

                    $group->get(
                        '',
                        \App\Actions\Products\ViewAllProductsAction::class
                    );

                    $group->get(
                        '/{id:[0-9]+}',
                        \App\Actions\Products\GetProductByIdAction::class
                    );

                    $group->get(
                        '/{slug:[0-9-a-zA-Z]+}',
                        \App\Actions\Products\GetProductBySlugAction::class
                    );

                    $group->post(
                        '/search',
                        \App\Actions\Products\SearchProductAction::class
                    );
                }
            );

            $group->post(
                '/createProduct',
                \App\Actions\Products\CreateProductAction::class
            );

            $group->put(
                '/updateProduct/{id:[0-9]+}',
                \App\Actions\Products\UpdateProductAction::class
            );

            $group->delete(
                '/deleteProduct/{id:[0-9]+}',
                \App\Actions\Products\DeleteProductAction::class
            );
        }
    );
};
