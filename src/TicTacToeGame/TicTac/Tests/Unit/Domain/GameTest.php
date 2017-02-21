<?php
declare(strict_types = 1);

namespace TicTacToeGame\TicTac\Tests\Domain;

/**
 * Class GameTest
 *
 * Test suite for TicTacToeGame\TicTac\Domain\Game class
 *
 * @package TicTacToeGame\TicTac\Tests\Domain
 */
class GameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that move for the positive case should return a Board
     */
    public function testMovePositiveCase()
    {
    }

    /**
     * expectedException \TicTacToeGame\TicTac\Exception\GameFinishStatusException
     */
    public function testMoveForAFinishGameShouldThrowAnException()
    {
    }

    /**
     * Test that Move For A Winner Move Should Finish The Game
     */
    public function testMoveForAWinnerMoveShouldFinishTheGame()
    {
    }
}
