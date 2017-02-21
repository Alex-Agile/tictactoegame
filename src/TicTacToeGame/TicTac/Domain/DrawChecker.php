<?php
declare(strict_types = 1);

namespace TicTacToeGame\TicTac\Domain;

/**
 * Trait DrawChecker
 *
 * Provides methods to check if draw condition is achieved
 *
 * @package TicTacToeGame\TicTac\Domain
 */
trait DrawChecker
{
    /**
     * Returns true if there is any empty position on board
     *
     * @param array $board
     *
     * @return bool
     */
    public function isMovesLeft(array $board): bool
    {
        foreach ($board as $row) {
            foreach ($row as $cell) {
                if (empty($cell)) {
                    return true;
                }
            }
        }
        return false;
    }
}
