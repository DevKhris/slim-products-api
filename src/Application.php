<?php



namespace App;

use Dotenv\Dotenv;
use DI\ContainerBuilder;
use DI\Bridge\Slim\Bridge;
use Doctrine\ORM\EntityManager;
use App\Providers\DoctrineProvider;
use App\Providers\ViewProvider;
use Odan\Session\PhpSession;
use Psr\Container\ContainerInterface;
use Slim\App;


class Application
{
    protected $container;

    protected $session;

    public App $application;

    public function __construct()
    {

        $config = Dotenv::createImmutable(
            APP_ROOT . DIRECTORY_SEPARATOR . '..'
        );

        $config->load();

        $builder = new ContainerBuilder();

        $this->container = $builder->build();

        $this->container->set('settings', $this->includeSettings());

        $this->container->set(
            SessionInterface::class,
            function (ContainerInterface $container) {
                $settings = $container->get('settings');
                $this->session = new PhpSession();
                $this->session->setOptions((array)$settings['session']);

                return $this->session;
            }
        );

        $this->container->set('session', $this->session);

        $this->container->set('view', ViewProvider::provide(null));

        $this->container->set(
            EntityManager::class,
            DoctrineProvider::provide($this->container)
        );

        $this->application = Bridge::create($this->container);
    }

    public function includeSettings(): array
    {
        $settings = include_once __DIR__ . '/config/settings.php';

        return $settings;
    }
}
