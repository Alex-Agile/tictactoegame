<?php
declare(strict_types = 1);

namespace TicTacToeGame\App\Middleware;

use Slim\App;

/**
 * Class MiddlewareLoader
 *
 * Invokable middleware loader object. Loads application Middleware components
 *
 * @package TicTacToeGame\App\Middleware
 */
final class MiddlewareLoader
{
    /**
     * Object invokable method
     *
     * Orchestrate Middleware loading process
     *
     * @param App $app
     */
    public function __invoke(App $app)
    {
        // TODO add middleware here
    }
}
