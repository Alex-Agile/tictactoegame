<?php
declare(strict_types = 1);

namespace TicTacToeGame\TicTac\Domain\Grid;

/**
 * Class Cell
 *
 * Represents a Tic Tac Toe board cell
 *
 * @package TicTacToeGame\TicTac\Domain\Grid
 */
class Cell
{
    /** @var string $team Team occupying the cell */
    private $team = '';

    /** @var bool $winner Indicates if this cell is part of a winning combination */
    private $winner = false;

    /**
     * Returns if cell is currently empty
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->getTeam());
    }

    /**
     * Team setter
     *
     * @param string $team
     *
     * @return Cell
     */
    public function setTeam(string $team): Cell
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Team getter
     *
     * @return string
     */
    public function getTeam(): string
    {
        return $this->team;
    }

    /**
     * Winner setter
     *
     * @param bool $winner
     *
     * @return Cell
     */
    public function setWinner(bool $winner): Cell
    {
        $this->winner = $winner;

        return $this;
    }

    /**
     * Winner getter
     *
     * @return bool
     */
    public function isWinner(): bool
    {
        return $this->winner;
    }
}
