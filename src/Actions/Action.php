<?php

namespace App\Actions;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class Action
{
    protected $container;

    protected $view;

    protected $entityManager;

    protected $session;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->view = $this->container->get('view');
        $this->entityManager = $this->container->get(EntityManager::class);

        /**
         * Session management
         * 
         * @var Odan\Session\PhpSession $session 
         */
        $this->session = $this->container->get('session');
    }
}
