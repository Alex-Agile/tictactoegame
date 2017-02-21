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
    }

    /**
     * Test Set Game Piece Positive Case
     */
    public function testSetGamePiecePositiveCase()
    {
    }

    /**
     * Test that Set Game Piece For An Invalid Position Should Thrown An Exception
     *
     * @expectedException \TicTacToeGame\TicTac\Exception\InvalidPositionException
     */
    public function testSetGamePieceForAnInvalidPositionShouldThrownAnException()
    {
    }

    /**
     * Test that Set Game Piece For An Occupied Position Should Thrown An Exception
     *
     * @expectedException \TicTacToeGame\TicTac\Exception\NotEmptyPositionException
     */
    public function testSetGamePieceForAnOccupiedPositionShouldThrownAnException()
    {
    }

    /**
     * Test that Status To Array Should Return Current Board Status As Array
     */
    public function testStatusToArrayShouldReturnCurrentBoardStatusAsArray()
    {
    }

    /**
     * Test that Json Serialize Should Return Current Board Status As Array
     */
    public function testJsonSerializeShouldReturnCurrentBoardStatusAsArray()
    {
    }
}
