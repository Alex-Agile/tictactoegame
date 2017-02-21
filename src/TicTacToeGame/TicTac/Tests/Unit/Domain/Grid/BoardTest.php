<?php
declare(strict_types = 1);

namespace TicTacToeGame\TicTac\Tests\Unit\Domain\Grid;

use TicTacToeGame\TicTac\Domain\Grid\Board;
use TicTacToeGame\TicTac\Domain\Grid\Cell;

/**
 * Class BoardTest
 *
 * Test suite for \TicTacToeGame\TicTac\Domain\Grid\Board class
 *
 * @package TicTacToeGame\TicTac\Tests\Unit\Domain\Grid
 */
class BoardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that Init Should Initialize An Empty Board
     */
    public function testInitShouldInitializeAnEmptyBoard()
    {
        $board = new Board();

        $boardState = $board->getBoardState();
        $this->assertTrue(is_array($boardState));
        $this->assertCount(3, $boardState);
        $this->assertTrue(is_array($boardState[0]));
    }

    /**
     * Test Set Game Piece Positive Case
     */
    public function testSetGamePiecePositiveCase()
    {
        $board = new Board();

        $this->assertTrue($board->setGamePiece(1, 1, 'X'));
    }
}
