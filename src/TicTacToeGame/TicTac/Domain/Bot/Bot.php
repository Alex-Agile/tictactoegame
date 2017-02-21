<?php
declare(strict_types = 1);

namespace TicTacToeGame\TicTac\Domain\Bot;

use TicTacToeGame\TicTac\Domain\Game;

/**
 * Class Bot
 *
 * Bot player. Uses minimax algorithm to play an unbeatable game
 *
 * @package TicTacToeGame\TicTac\Domain\Bot
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
