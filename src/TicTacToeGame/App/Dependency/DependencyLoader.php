<?php
declare(strict_types = 1);

namespace TicTacToeGame\App\Dependency;

use Interop\Container\ContainerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Slim\App;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

/**
 * Class DependencyLoader
 *
 * Invokable dependency loader object. Loads application dependencies
 *
 * @package TicTacToeGame\App\Dependency
 */
final class DependencyLoader
{
    /**
     * Object invokable method
     *
     * Orchestrate Dependency loading process
     *
     * @param App $app
     */
    public function __invoke(App $app)
    {
        $container = $app->getContainer();

        // Twig
        $container['view'] = $this->addResponder($container);

        // Monolog
        $container['logger'] = $this->addLogger($container);
    }

    /**
     * Adds Responders (views) handler
     *
     * @param ContainerInterface $container
     *
     * @return Twig
     */
    private function addResponder(ContainerInterface $container)
    {
        if ($container->get('settings')['twig']['cache']) {
            $view = new Twig($container->get('settings')['twig']['template_path'], [
                'cache' => $container->get('settings')['twig']['cache_path'],
            ]);
        } else {
            $view = new Twig($container->get('settings')['twig']['template_path']);
        }

        // Instantiate and add Slim specific extension
        $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
        $view->addExtension(new TwigExtension($container['router'], $basePath));

        return $view;
    }

    /**
     * Adds logger handler
     *
     * @param ContainerInterface $container
     *
     * @return Logger
     */
    private function addLogger(ContainerInterface $container)
    {
        $settings = $container->get('settings')['logger'];
        $logger = new Logger($settings['name']);
        $logger->pushProcessor(new UidProcessor());
        $logger->pushHandler(new StreamHandler($settings['path'], $settings['level']));
        return $logger;
    }
}
