<?php
declare(strict_types = 1);

namespace TicTacToeGame\TicTac\Route;

use TicTacToeGame\TicTac\Domain\Grid\Board;
use TicTacToeGame\TicTac\Domain\Game;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

/**
 * Class RouteLoader
 *
 * Invokable Route loader object for TicTacToeGame\TicTac\Route package
 *
 * @package TicTacToeGame\TicTac\Route
 */
class RouteLoader
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
        /**
         * Homepage route
         */
        $app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) use ($app) {
            /** @var Logger $logger */
            $logger = $app->getContainer()->get('logger');
            $logger->addDebug("Route 'home' matched");

            // render game player selection
            return $this->view->render($response, 'index.twig');
        })->setName('home');

        /**
         * Game board route
         */
        $app->get('/board/{option}', function (ServerRequestInterface $request, ResponseInterface $response, array $args = null) use ($app) {
            /** @var Logger $logger */
            $logger = $app->getContainer()->get('logger');
            $logger->addDebug("Route 'board' matched");

            // initialize a new game
            $_SESSION['game'] = new Game(new Board());
            $_SESSION['authToken'] = bin2hex(openssl_random_pseudo_bytes(16));

            // render game board
            return $this->view->render($response, 'board.twig', [
                'gameType' => $args['option'],
                'authToken' => $_SESSION['authToken'],
            ]);
        })->setName('board');
    }
}
