<?php
declare(strict_types = 1);

namespace Docler\TicTac\Tests\Unit\Domain;

use Docler\TicTac\Domain\DrawChecker;

/**
 * Class DrawCheckerTest
 *
 * Test suite for Docler\TicTac\Domain\DrawChecker trait
 *
 * @package Docler\TicTac\Tests\Unit\Domain
 */
class DrawCheckerTest extends \PHPUnit_Framework_TestCase
{
    /** @var DrawChecker Object using the trait */
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
        $this->traitObject = $this->getObjectForTrait(DrawChecker::class);
    }

    /**
     * Test that Is Moves Left Should Return True For A Non Full Board
     */
    public function testIsMovesLeftShouldReturnTrueForANonFullBoard()
    {
        $this->assertTrue($this->traitObject->isMovesLeft([
            ['', '', ''],
            ['', '', ''],
            ['', '', ''],
        ]));
    }

    /**
     * Test that Is Moves Left Should Return False For A Full Board
     */
    public function testIsMovesLeftShouldReturnFalseForAFullBoard()
    {
        $this->assertFalse($this->traitObject->isMovesLeft([
            ['X', 'O', 'X'],
            ['O', 'X', 'O'],
            ['X', 'O', 'X'],
        ]));
    }
}
