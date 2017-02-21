<?php
declare(strict_types = 1);

namespace TicTacToeGame\TicTac\Tests\Unit\Domain;

use TicTacToeGame\TicTac\Domain\VictoryChecker;

/**
 * Class VictoryCheckerTest
 *
 * Test suite for TicTacToeGame\TicTac\Domain\VictoryChecker trait
 *
 * @package TicTacToeGame\TicTac\Tests\Unit\Domain
 */
class VictoryCheckerTest extends \PHPUnit_Framework_TestCase
{
    /** @var VictoryChecker Object using the trait */
    private $traitObject;

    /**
     * Sets up the fixture.
     *
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $this->traitObject = $this->getObjectForTrait(VictoryChecker::class);
    }

    /**
     * Test that IsWinner Should Return A Non Empty Array When A Winner Exists
     */
    public function testIsWinnerShouldReturnANonEmptyArrayWhenAWinnerExists()
    {
        $this->assertEquals([
            'team' => 'X',
            'coordinates' => [
                [0, 0],
                [0, 1],
                [0, 2],
            ],
        ], $this->traitObject->isAWinner([
            ['X', 'X', 'X'],
            ['O', 'O', ''],
            ['', '', ''],
        ]));
    }

    /**
     * Test that IsWinner Should Return An Empty Array When A Winner Not Exists
     */
    public function testIsWinnerShouldReturnAnEmptyArrayWhenAWinnerNotExists()
    {
        $this->assertEquals([], $this->traitObject->isAWinner([
            ['', '', ''],
            ['', '', ''],
            ['', '', ''],
        ]));
    }
}
