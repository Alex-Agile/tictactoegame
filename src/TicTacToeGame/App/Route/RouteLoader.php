<?php
declare(strict_types = 1);

namespace TicTacToeGame\App\Route;

use Slim\App;

/**
 * Class RouteLoader
 *
 * Invokable Route loader object. Invokes application route loaders
 *
 * @package TicTacToeGame\App\Route
 */
final class RouteLoader
{
    /**
     * Object invokable method
     *
     * Orchestrate Route loading process
     *
     * @param App $app
     */
    public function __invoke(App $app)
    {
        // Api module routes loading
        (new \TicTacToeGame\Api\V1\Route\RouteLoader())($app);

        // TicTac module routes loading
        (new \TicTacToeGame\TicTac\Route\RouteLoader())($app);
    }
}
