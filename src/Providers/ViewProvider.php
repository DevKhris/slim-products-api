<?php

namespace App\Providers;

use Slim\Views\PhpRenderer;
use Psr\Container\ContainerInterface;
use App\Interfaces\ServiceProviderInterface;

final class ViewProvider implements ServiceProviderInterface
{
    public static function provide(?ContainerInterface $container): PhpRenderer
    {
        return new PhpRenderer(APP_ROOT . DIRECTORY_SEPARATOR . 'views');
    }
}
