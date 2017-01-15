<?php
declare(strict_types = 1);

namespace Docler\TicTac\Tests\Integration;

use Docler\App\Tests\Integration\IntegrationBaseTestCase;

/**
 * Class TicTacTest
 *
 * Integration tests for homepage
 *
 * @package Docler\TicTac\Tests\Integration
 */
class TicTacTest extends IntegrationBaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the title text
     */
    public function testGetHomepageShouldContainHomepageTitle()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('<title>The Tic Tac Toe Game - Alejandro Barba Prieto</title>', (string)$response->getBody());
    }

    /**
     * Test that board route for onw player should render a response containing game board
     */
    public function testGetOnePlayerGameShouldContainGameBoard()
    {
        $response = $this->runApp('GET', '/board/one-player');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('<div id="board-container">', (string)$response->getBody());
    }

    /**
     * Test that board route for two player should render a response containing game board
     */
    public function testGetTwoPlayerGameShouldContainGameBoard()
    {
        $response = $this->runApp('GET', '/board/two-player');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('<div id="board-container">', (string)$response->getBody());
    }
}
