<?php
declare(strict_types = 1);

namespace Docler\Api\V1\Tests\Integration;

use Docler\App\Tests\Integration\IntegrationBaseTestCase;
use Docler\TicTac\Domain\Game;
use Docler\TicTac\Domain\Grid\Board;

/**
 * Class ApiTest
 *
 * Integration tests for homepage
 *
 * @package Docler\Api\V1\Tests\Integration
 */
class ApiTest extends IntegrationBaseTestCase
{
    /**
     * Test that Correct Api Move Call With Valid Authentication Should Return A Valid Response
     */
    public function testCorrectApiMoveCallWithValidAuthenticationShouldReturnAValidResponse()
    {
        $_SESSION['authToken'] = 'MOCK_AUTHORIZATION_CODE';
        $_SESSION['game'] = new Game(new Board());

        $response = $this->runApp('PUT', '/api/v1/move', [
            'coordinate_x' => 1,
            'coordinate_y' => 1,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(json_encode([
            'result' => true,
            'data'   => [
                'gameOver' => false,
                'board'    => [
                    [
                        ['team' => '', 'winner' => false],
                        ['team' => '', 'winner' => false],
                        ['team' => '', 'winner' => false],
                    ],
                    [
                        ['team' => '', 'winner' => false],
                        ['team' => 'X', 'winner' => false],
                        ['team' => '', 'winner' => false],
                    ],
                    [
                        ['team' => '', 'winner' => false],
                        ['team' => '', 'winner' => false],
                        ['team' => '', 'winner' => false],
                    ],
                ],
            ],
        ]), (string)$response->getBody());
    }

    /**
     * Test that Correct Api Move Call With Invalid Authentication Should Return A Forbidden Response
     */
    public function testCorrectApiMoveCallWithInvalidAuthenticationShouldReturnAForbiddenResponse()
    {
        $_SESSION['authToken'] = 'INVALID_AUTHORIZATION_CODE';
        $_SESSION['game'] = new Game(new Board());

        $response = $this->runApp('PUT', '/api/v1/move', [
            'coordinate_x' => 1,
            'coordinate_y' => 1,
        ]);

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertEquals(json_encode([
            'result' => false,
            'data'   => [
                'gameOver' => true,
                'message' => 'Authorization error.'
            ],
        ]), (string)$response->getBody());
    }

    /**
     * Test that Correct Api Bot Move Call With Valid Authentication Should Return A Valid Response
     */
    public function testCorrectApiBotMoveCallWithValidAuthenticationShouldReturnAValidResponse()
    {
        $_SESSION['authToken'] = 'MOCK_AUTHORIZATION_CODE';
        $_SESSION['game'] = new Game(new Board());

        $response = $this->runApp('PUT', '/api/v1/bot-move', [
            'coordinate_x' => 1,
            'coordinate_y' => 1,
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(json_encode([
            'result' => true,
            'data'   => [
                'gameOver' => false,
                'board'    => [
                    [
                        ['team' => 'X', 'winner' => false],
                        ['team' => '', 'winner' => false],
                        ['team' => '', 'winner' => false],
                    ],
                    [
                        ['team' => '', 'winner' => false],
                        ['team' => '', 'winner' => false],
                        ['team' => '', 'winner' => false],
                    ],
                    [
                        ['team' => '', 'winner' => false],
                        ['team' => '', 'winner' => false],
                        ['team' => '', 'winner' => false],
                    ],
                ],
            ],
        ]), (string)$response->getBody());
    }

    /**
     * Test that Correct Api Bot Move Call With Invalid Authentication Should Return A Forbidden Response
     */
    public function testCorrectApiBotMoveCallWithInvalidAuthenticationShouldReturnAForbiddenResponse()
    {
        $_SESSION['authToken'] = 'INVALID_AUTHORIZATION_CODE';
        $_SESSION['game'] = new Game(new Board());

        $response = $this->runApp('PUT', '/api/v1/bot-move', [
            'coordinate_x' => 1,
            'coordinate_y' => 1,
        ]);

        $this->assertEquals(403, $response->getStatusCode());
        $this->assertEquals(json_encode([
            'result' => false,
            'data'   => [
                'gameOver' => true,
                'message' => 'Authorization error.'
            ],
        ]), (string)$response->getBody());
    }
}
