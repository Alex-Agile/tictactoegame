<?php
declare(strict_types = 1);

namespace Docler\TicTac\Domain\Bot;

use Docler\TicTac\Domain\Game;

/**
 * Class Bot
 *
 * Bot player. Uses minimax algorithm to play an unbeatable game
 *
 * @package Docler\TicTac\Domain\Bot
 */
class Bot implements MoveInterface
{
    use MinimaxAlgorithm;

    /**
     * Returns coordinates for optimal move based on current board status
     *
     * @param array  $boardState
     * @param string $playerUnit
     *
     * @return array
     */
    public function makeMove(array $boardState, string $playerUnit = Game::GAME_TEAM_X)
    {
        return $this->findBestMove($boardState, $playerUnit);
    }
}
