<?php
declare(strict_types = 1);

namespace TicTacToeGame\TicTac\Tests\Unit\Domain\Bot;

use TicTacToeGame\TicTac\Domain\Bot\Bot;

/**
 * Class BotTest
 *
 * Test suite for \TicTacToeGame\TicTac\Domain\Bot\Bot class
 *
 * @package TicTacToeGame\TicTac\Tests\Unit\Domain\Bot
 */
class BotTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that Best Move For Winnable Status Should Return Winnable Move Coordinates
     */
    public function testBestMoveForWinnableStatusShouldReturnWinnableMoveCoordinates()
    {
        $bot = new Bot();

        $this->assertEquals([2, 0], $bot->makeMove([
            ['X', 'X', ''],
            ['O', 'X', 'X'],
            ['', 'O', 'O'],
        ], 'O'));
    }

    /**
     * Test that Best Move For Defending Status Should Return Defending Move Coordinates
     */
    public function testBestMoveForDefendingStatusShouldReturnDefendingMoveCoordinates()
    {
        $bot = new Bot();

        $this->assertEquals([2, 2], $bot->makeMove([
            ['X', '', 'O'],
            ['O', 'X', ''],
            ['X', '', ''],
        ], 'O'));
    }
}
