<?php
declare(strict_types = 1);

namespace TicTacToeGame\Api\V1\Route;

use TicTacToeGame\Api\V1\Action\BotMoveAction;
use TicTacToeGame\Api\V1\Action\MoveAction;
use TicTacToeGame\App\Middleware\OauthMiddleware;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

/**
 * Class RouteLoader
 *
 * Invokable Route loader object for TicTacToeGame\Api\V1\Route package
 *
 * @package TicTacToeGame\Api\V1\Route
 * @SWG\Info(
 *      title="TicTacToeGame Tic Tac Toe Api V1", version="1.0",
 * )
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

        $app->group('/api', function () use ($app) {

            // Version group
            $app->group('/v1', function () use ($app) {

                /**
                 * @SWG\Put(
                 *     path="/api/v1/move",
                 *     @SWG\Response(
                 *          response="200",
                 *          description="Request the Game to place a new game piece."
                 *      )
                 * )
                 */
                $app->put('/move', function (ServerRequestInterface $request, ResponseInterface $response) use ($app) {
                    /** @var Logger $logger */
                    $logger = $app->getContainer()->get('logger');
                    $logger->addDebug("Route 'move' matched");

                    // get request params
                    $requestParams = $request->getParsedBody();

                    // execute move
                    $moveResult = (new MoveAction())(
                        $_SESSION['game'],
                        (int)$requestParams['coordinate_x'],
                        (int)$requestParams['coordinate_y']
                    );

                    // write response
                    $response->getBody()->write(json_encode($moveResult));
                    return $response->withHeader('Content-Type', 'application/json')->withBody($response->getBody());
                })->setName('move');

                /**
                 * @SWG\Put(
                 *     path="/api/v1/bot-move",
                 *     @SWG\Response(
                 *          response="200",
                 *          description="Request the Game Bot to chose a new move to place a new game piece."
                 *      )
                 * )
                 */
                $app->put('/bot-move', function (ServerRequestInterface $request, ResponseInterface $response) use ($app) {
                    /** @var Logger $logger */
                    $logger = $app->getContainer()->get('logger');
                    $logger->addDebug("Route 'bot-move' matched");

                    // ask game bot to perform a new move
                    $moveResult = (new BotMoveAction())($_SESSION['game']);

                    // write response
                    $response->getBody()->write(json_encode($moveResult));
                    return $response->withHeader('Content-Type', 'application/json')->withBody($response->getBody());
                })->setName('bot-move');
            });
        })->add(new OauthMiddleware($app)); // adds API only middleware
    }
}
