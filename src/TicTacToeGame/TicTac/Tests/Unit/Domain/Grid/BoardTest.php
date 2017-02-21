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
        $board->init();

        $boardState = $board->getBoardState();
        $this->assertTrue(is_array($boardState));
        $this->assertCount(3, $boardState);
        $this->assertTrue(is_array($boardState[0]));
        $this->assertInstanceOf(Cell::class, $boardState[0][0]);
    }

    /**
     * Test Set Game Piece Positive Case
     */
    public function testSetGamePiecePositiveCase()
    {
        $board = new Board();
        $board->init();

        $this->assertTrue($board->setGamePiece(1, 1, 'X'));
    }

    /**
     * Test that Set Game Piece For An Invalid Position Should Thrown An Exception
     *
     * @expectedException \TicTacToeGame\TicTac\Exception\InvalidPositionException
     */
    public function testSetGamePieceForAnInvalidPositionShouldThrownAnException()
    {
        $board = new Board();
        $board->init();

        $board->setGamePiece(4, 4, 'X');
    }

    /**
     * Test that Set Game Piece For An Occupied Position Should Thrown An Exception
     *
     * @expectedException \TicTacToeGame\TicTac\Exception\NotEmptyPositionException
     */
    public function testSetGamePieceForAnOccupiedPositionShouldThrownAnException()
    {
        $board = new Board();
        $board->init();

        $board->setGamePiece(1, 1, 'X');
        $board->setGamePiece(1, 1, 'O');
    }
}
