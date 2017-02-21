<?php
declare(strict_types = 1);

namespace TicTacToeGame\App\Tests\Integration;

use TicTacToeGame\App\Config\SettingsStore;
use TicTacToeGame\App\Dependency\DependencyLoader;
use TicTacToeGame\App\Middleware\MiddlewareLoader;
use TicTacToeGame\App\Route\RouteLoader;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;

/**
 * This is an example class that shows how you could set up a method that
 * runs the application. Note that it doesn't cover all use-cases and is
 * tuned to the specifics of this skeleton app, so if your needs are
 * different, you'll need to change it.
 */
class IntegrationBaseTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Use middleware when running application?
     *
     * @var bool
     */
    protected $withMiddleware = true;

    /**
     * Process the application given a request method and URI
     *
     * @param string $requestMethod the request method (e.g. GET, POST, etc.)
     * @param string $requestUri the request URI
     * @param array|object|null $requestData the request data
     *
     * @return \Psr\Http\Message\ResponseInterface|Response
     */
    public function runApp($requestMethod, $requestUri, $requestData = null)
    {
        // Create a mock environment for testing with
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri,
                'HTTP_AUTHORIZATION' => 'MOCK_AUTHORIZATION_CODE',
            ]
        );

        // Set up a request object based on the environment
        $request = Request::createFromEnvironment($environment);

        // Add request data, if it exists
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }

        // Set up a response object
        $response = new Response();

        // Use the application settings
        $settings = SettingsStore::getSettings(SettingsStore::ENV_TESTING);

        // Instantiate the application
        $app = new App($settings);

        // Set up dependencies
        (new DependencyLoader())($app);

        // Register middleware
        if ($this->withMiddleware) {
            (new MiddlewareLoader())($app);
        }

        // Register routes
        (new RouteLoader())($app);

        // Process the application
        $response = $app->process($request, $response);

        // Return the response
        return $response;
    }
}
