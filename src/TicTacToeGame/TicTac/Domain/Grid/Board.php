<?php
declare(strict_types = 1);

namespace TicTacToeGame\TicTac\Domain\Grid;

use TicTacToeGame\TicTac\Exception\InvalidPositionException;
use TicTacToeGame\TicTac\Exception\NotEmptyPositionException;

/**
 * Class Board
 *
 * Represents a Tic Tac Toe board
 *
 * @package TicTacToeGame\TicTac\Domain\Grid
 */
class Board
{
    /** @var array $boardState Current board status */
    private $boardState = [];

    /**
     * Board constructor.
     */
    public function __construct()
    {
        $this->boardState = [
            ['','',''],
            ['','',''],
            ['','',''],
        ];
    }

    /**
     * Sets $team game piece on specified position
     *
     * @param int $x X coordinate
     * @param int $y Y coordinate
     * @param string $team Current turn team (X or O)
     *
     * @return bool True if successful
     *
     * @throws InvalidPositionException If position doesn't exist
     * @throws NotEmptyPositionException If position is already occupied
     */
    public function setGamePiece(int $x, int $y, string $team): bool
    {
        $this->boardState[$x][$y] = $team;

        return true;
    }

    /**
     * BoardState setter
     *
     * @param array $boardState
     *
     * @return Board
     */
    public function setBoardState(array $boardState): Board
    {
        $this->boardState = $boardState;
        return $this;
    }

    /**
     * BoardState setter
     *
     * @return array
     */
    public function getBoardState(): array
    {
        return $this->boardState;
    }
}
