#!/usr/bin/env php
<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

$application = include_once __DIR__ . '/src/app/bootstrap.php';

$entityManager = $application->getContainer()->get(EntityManager::class);

return ConsoleRunner::run(new SingleManagerProvider($entityManager));
