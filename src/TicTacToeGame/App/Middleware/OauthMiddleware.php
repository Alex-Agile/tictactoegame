<?php
declare(strict_types = 1);

namespace TicTacToeGame\App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;

/**
 * Class OauthMiddleware
 *
 * OAuth middelware for Api calls
 *
 * @package TicTacToeGame\App\Middleware
 */
class OauthMiddleware
{
    /** @var App $app Slim App handler */
    private $app;

    /**
     * OauthMiddleware constructor.
     *
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->setApp($app);
    }

    /**
     * Object invokable method
     *
     * Handles Api authentication
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable               $next
     *
     * @return ResponseInterface
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ): ResponseInterface
    {
        $headersArray = $request->getHeaders();

        // no auth header
        if (
            empty($headersArray['HTTP_AUTHORIZATION'][0]) ||
            !$this->validateToken($headersArray['HTTP_AUTHORIZATION'][0])
        ) {
            $response->getBody()->write(json_encode([
                'result' => false,
                'data'   => [
                    'gameOver' => true,
                    'message'  => 'Authorization error.',
                ],
            ]));
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(403)
                ->withBody($response->getBody());
        }
        return $next($request, $response);
    }

    /**
     * Validate auth token
     *
     * @param string $token
     *
     * @return bool
     */
    private function validateToken(string $token): bool
    {
        return ($_SESSION['authToken'] == $token);
    }

    /**
     * App setter
     *
     * @param mixed $app
     *
     * @return OauthMiddleware
     */
    public function setApp($app)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * App getter
     *
     * @return mixed
     */
    public function getApp()
    {
        return $this->getApp();
    }
}
