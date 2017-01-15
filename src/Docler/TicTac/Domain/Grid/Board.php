<?php
declare(strict_types = 1);

namespace Docler\TicTac\Domain\Grid;

use Docler\TicTac\Exception\InvalidPositionException;
use Docler\TicTac\Exception\NotEmptyPositionException;

/**
 * Class Board
 *
 * Represents a Tic Tac Toe board
 *
 * @package Docler\TicTac\Domain\Grid
 */
class Board implements \JsonSerializable
{
    /** @var array $boardState Current board status */
    private $boardState = [];

    /**
     * Initializes board status
     */
    public function init()
    {
        $this->boardState = [
            [new Cell(), new Cell(), new Cell()],
            [new Cell(), new Cell(), new Cell()],
            [new Cell(), new Cell(), new Cell()],
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
        // get boardState
        $boardState = $this->getBoardState();

        // check if position is valid
        if (!array_key_exists($x, $boardState) || !array_key_exists($y, $boardState[$x])) {
            throw new InvalidPositionException("Not possible to move to $x, $y. Not existing coordinates.");
        }

        /** @var Cell $cell */
        $cell = $boardState[$x][$y];

        // check if position is empty
        if (!$cell->isEmpty()) {
            throw new NotEmptyPositionException("Not possible to move to $x, $y. Cell already occupied.");
        }

        // set position and boardState
        $cell->setTeam($team);
        $this->setBoardState($boardState);

        return true;
    }

    /**
     * Returns current board status as an array of string arrays
     *
     * @return array
     */
    public function statusToArray()
    {
        $status = [];

        $board = $this->getBoardState();
        foreach ($board as $row) {
            $rowArray = [];

            /** @var Cell $cell */
            foreach ($row as $cell) {
                $rowArray[] = $cell->getTeam();
            }

            $status[] = $rowArray;
        }

        return $status;
    }

    /**
     * Serializes current board status for json_encode methods
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $json = [];

        $board = $this->getBoardState();
        foreach ($board as $row) {
            $jsonRow = [];

            /** @var Cell $cell */
            foreach ($row as $cell) {
                $jsonRow[] = [
                    'team' => $cell->getTeam(),
                    'winner' => $cell->isWinner(),
                ];
            }

            $json[] = $jsonRow;
        }

        return $json;
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
