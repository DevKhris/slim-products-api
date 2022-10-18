<?php

namespace App\Providers;

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use App\Interfaces\ServiceProviderInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * ServiceProvider for registering DoctrineORM service into container
 * 
 */
final class DoctrineProvider implements ServiceProviderInterface
{
    /** */
    public static function provide(?ContainerInterface $container): EntityManager
    {
        $settings = $container->get('settings');

        $connection = $settings['doctrine']['connection'];
        $cacheSettings = $settings['doctrine']['development'] ?
            new ArrayAdapter() :
            new FilesystemAdapter(directory: $settings['doctrine']['cache_dir']);

        $config = ORMSetup::createAnnotationMetadataConfiguration(
            $settings['doctrine']['metadata_dirs'],
            $settings['doctrine']['development'],
            null,
            $cacheSettings ?? null
        );


        return EntityManager::create($connection, $config);
    }
}
