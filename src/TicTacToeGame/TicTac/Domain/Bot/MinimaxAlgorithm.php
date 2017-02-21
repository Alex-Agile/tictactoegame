<?php
declare(strict_types = 1);

namespace TicTacToeGame\TicTac\Domain\Bot;

use TicTacToeGame\TicTac\Domain\DrawChecker;
use TicTacToeGame\TicTac\Domain\Game;
use TicTacToeGame\TicTac\Domain\VictoryChecker;

/**
 * Trait MinimaxAlgorithm
 *
 * Implementation of the Minimax algorithm
 *
 * Provides methods to decide next optimal Tic Tac Toe move
 *
 * @package TicTacToeGame\TicTac\Domain\Bot
 */
trait MinimaxAlgorithm
{
    use VictoryChecker;
    use DrawChecker;

    /**
     * Decides which one of the remaining moves is the best one
     *
     * @param array  $boardState Current board status
     * @param string $playerUnit Team currently playing
     *
     * @return array Best move coordinates
     */
    public function findBestMove(array $boardState, string $playerUnit): array
    {
        $coordinateX = 0;
        $coordinateY = 0;
        $bestValue = -1000;

        // foreach row
        for ($i = 0; $i < count($boardState); $i++) {
            // foreach cell
            for ($j = 0; $j < count($boardState[$i]); $j++) {
                // if empty cell
                if (empty($boardState[$i][$j])) {
                    // make the move
                    $boardState[$i][$j] = $playerUnit;

                    // compute evaluation function for this move.
                    $moveValue = $this->minimax($boardState, 0, false);

                    // undo the move
                    $boardState[$i][$j] = '';

                    // if the value of the current move is bigger than the bestValue update bestValue
                    if ($moveValue > $bestValue) {
                        $bestValue = $moveValue;
                        $coordinateX = $i;
                        $coordinateY = $j;
                    }
                }
            }
        }

        // return best move
        return [$coordinateX, $coordinateY];
    }

    /**
     * Minimax algorithm implemantation
     *
     * Recursive method
     *
     * @param array $boardState         Current board status
     * @param int   $depth              Iteration level
     * @param bool  $isMaximizingPlayer My team or opponent team
     *
     * @return int
     */
    private function minimax(array $boardState, int $depth, bool $isMaximizingPlayer): int
    {
        // if there is a winner returns min or max score
        $winner = $this->isAWinner($boardState);
        if (!empty($winner)) {
            return ($winner['team'] === Game::BOT_TEAM ? 10 : -10);
        }

        // if not moves left returns draw
        if (!$this->isMovesLeft($boardState)) {
            return 0;
        }

        // my team
        if ($isMaximizingPlayer) {
            $bestMove = -1000;
            for ($i = 0; $i < count($boardState); $i++) {
                for ($j = 0; $j < count($boardState[$i]); $j++) {
                    if (empty($boardState[$i][$j])) {
                        // make the move
                        $boardState[$i][$j] = Game::BOT_TEAM;

                        // call minimax recursively and choose the maximum value
                        $bestMove = max($bestMove, $this->minimax($boardState, $depth + 1, !$isMaximizingPlayer));

                        // undo the move
                        $boardState[$i][$j] = '';
                    }
                }
            }
            return $bestMove;
        } else { // opponent team
            $bestMove = 1000;
            for ($i = 0; $i < count($boardState); $i++) {
                for ($j = 0; $j < count($boardState[$i]); $j++) {
                    if (empty($boardState[$i][$j])) {
                        // make the move
                        $boardState[$i][$j] = Game::OPPONENT_TEAM;

                        // call minimax recursively and choose the minimum value
                        $bestMove = min($bestMove, $this->minimax($boardState, $depth + 1, !$isMaximizingPlayer));

                        // undo the move
                        $boardState[$i][$j] = '';
                    }
                }
            }
            return $bestMove;
        }
    }
}
