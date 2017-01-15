<?php
declare(strict_types = 1);

namespace Docler\TicTac\Tests\Unit\Domain\Bot;

use Docler\TicTac\Domain\Bot\MinimaxAlgorithm;

/**
 * Class MinimaxAlgorithmTest
 *
 * Test suite for \Docler\TicTac\Domain\Bot\MinimaxAlgorithm trait
 *
 * @package Docler\TicTac\Tests\Unit\Domain\Bot
 */
class MinimaxAlgorithmTest extends \PHPUnit_Framework_TestCase
{
    /** @var MinimaxAlgorithm Object using the trait */
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
        $this->traitObject = $this->getObjectForTrait(MinimaxAlgorithm::class);
    }

    /**
     * Test that Best Move For Winnable Status Should Return Winnable Move Coordinates
     */
    public function testBestMoveForWinnableStatusShouldReturnWinnableMoveCoordinates()
    {
        $this->assertEquals([2, 0], $this->traitObject->findBestMove([
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
        $this->assertEquals([2, 2], $this->traitObject->findBestMove([
            ['X', '', 'O'],
            ['O', 'X', ''],
            ['X', '', ''],
        ], 'O'));
    }
}
