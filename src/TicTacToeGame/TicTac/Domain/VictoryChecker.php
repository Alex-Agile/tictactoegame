<?php
declare(strict_types = 1);

namespace TicTacToeGame\TicTac\Domain;

/**
 * Trait VictoryChecker
 *
 * Provides methods to check if any team is currently winning
 *
 * @package TicTacToeGame\TicTac\Domain
 */
trait VictoryChecker
{
    /**
     * Checks if there is any winner
     *
     * Returns an array containing the winner team and winning cell positions. An empty array else
     *
     * @param array $board
     *
     * @return array
     */
    public function isAWinner(array $board): array
    {
        if ($winner = $this->rowWin($board)) {
            return $winner;
        } elseif ($winner = $this->columnWin($board)) {
            return $winner;
        } elseif ($winner = $this->diagonalsWin($board)) {
            return $winner;
        }

        return $winner;
    }

    /**
     * Checks if there is a winner in any row
     *
     * @param array $board
     *
     * @return array
     */
    private function rowWin(array $board): array
    {
        for ($i = 0; $i < 3; $i++) {
            if (!empty($board[$i][0]) && $board[$i][0] == $board[$i][1] && $board[$i][0] == $board[$i][2]) {
                return [
                    'team' => $board[$i][0],
                    'coordinates' => [
                        [$i, 0],
                        [$i, 1],
                        [$i, 2],
                    ],
                ];
            }
        }

        return [];
    }

    /**
     * Checks if there is a winner in any column
     *
     * @param array $board
     *
     * @return array
     */
    private function columnWin(array $board): array
    {
        for ($j = 0; $j < 3; $j++) {
            if (!empty($board[0][$j]) && $board[0][$j] == $board[1][$j] && $board[0][$j] == $board[2][$j]) {
                return [
                    'team' => $board[0][$j],
                    'coordinates' => [
                        [0, $j],
                        [1, $j],
                        [2, $j],
                    ],
                ];
            }
        }

        return [];
    }

    /**
     * Checks if there is a winner in any diagonal
     *
     * @param array $board
     *
     * @return array
     */
    private function diagonalsWin(array $board): array
    {
        // check diagonal 1
        if (!empty($board[0][0]) && $board[0][0] == $board[1][1] && $board[0][0] == $board[2][2]) {
            return [
                'team' => $board[0][0],
                'coordinates' => [
                    [0, 0],
                    [1, 1],
                    [2, 2],
                ],
            ];
        }

        // check diagonal 2
        if (!empty($board[0][2]) && $board[0][2] == $board[1][1] && $board[0][2] == $board[2][0]) {
            return [
                'team' => $board[0][2],
                'coordinates' => [
                    [0, 2],
                    [1, 1],
                    [2, 0],
                ],
            ];
        }

        return [];
    }
}
