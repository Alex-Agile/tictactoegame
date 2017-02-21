<?php
declare(strict_types = 1);

namespace TicTacToeGame\TicTac\Tests\Domain;

use TicTacToeGame\TicTac\Domain\Game;
use TicTacToeGame\TicTac\Domain\Grid\Board;
use TicTacToeGame\TicTac\Domain\Grid\Cell;

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
        // generate board mock
        $boardMock = $this->getMockBuilder(Board::class)
            ->disableOriginalConstructor()
            ->setMethods([
                    'init',
                    'setGamePiece',
                    'statusToArray',
            ])
            ->getMock();

        // set board mock method expectations
        $boardMock->expects($this->once())
            ->method('init');

        $boardMock->expects($this->once())
            ->method('statusToArray')
            ->willReturn([
                ['','','',],
                ['','','',],
                ['','','',],
            ]);

        $boardMock->expects($this->once())
            ->method('setGamePiece')
            ->willReturn(true);

        $game = new Game($boardMock);

        $this->assertEquals($boardMock, $game->move(0, 0));
    }

    /**
     * @expectedException \TicTacToeGame\TicTac\Exception\GameFinishStatusException
     */
    public function testMoveForAFinishGameShouldThrowAnException()
    {
        // generate board mock
        $boardMock = $this->getMockBuilder(Board::class)
            ->disableOriginalConstructor()
            ->setMethods([
                    'init',
                    'setGamePiece']
            )
            ->getMock();

        $game = new Game($boardMock);
        $game->setGameStatus(Game::GAME_STATUS_FINISH);

        $this->assertEquals($boardMock, $game->move(0, 0));
    }

    /**
     * Test that Move For A Winner Move Should Finish The Game
     */
    public function testMoveForAWinnerMoveShouldFinishTheGame()
    {
        // generate board mock
        $boardMock = $this->getMockBuilder(Board::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'init',
                'setGamePiece',
                'statusToArray',
                'getBoardState',
            ])
            ->getMock();

        // set board mock method expectations
        $boardMock->expects($this->once())
            ->method('init');

        $boardMock->expects($this->once())
            ->method('setGamePiece')
            ->willReturn(true);

        $boardMock->expects($this->once())
            ->method('statusToArray')
            ->willReturn([
                ['X','O','',],
                ['','X','O',],
                ['','','X',],
            ]);

        $boardMock->expects($this->exactly(3))
            ->method('getBoardState')
            ->willReturn([
                [new Cell(), new Cell(), new Cell()],
                [new Cell(), new Cell(), new Cell()],
                [new Cell(), new Cell(), new Cell()],
            ]);

        $game = new Game($boardMock);
        $game->move(0, 0);

        $this->assertEquals(Game::GAME_STATUS_FINISH, $game->getGameStatus()); 
    }
}
