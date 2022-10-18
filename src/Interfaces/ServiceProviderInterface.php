<?php

namespace App\Interfaces;

use Psr\Container\ContainerInterface;

/**
 * ServiceProvider pattern interface
 */
interface ServiceProviderInterface
{
    /**
     * Provide function for dependency injection
     *
     * @param Container|null $container Inversion of Control container
     * 
     * @return void
     */
    public static function provide(?ContainerInterface $container);
}
