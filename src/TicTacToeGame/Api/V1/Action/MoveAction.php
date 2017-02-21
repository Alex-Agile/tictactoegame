<?php
declare(strict_types = 1);

namespace TicTacToeGame\Api\V1\Action;

use TicTacToeGame\TicTac\Domain\Game;
use TicTacToeGame\TicTac\Exception\GameFinishStatusException;

/**
 * Class MoveAction
 *
 * Action (ADR) class for Human move Api call
 *
 * @package TicTacToeGame\Api\V1\Action
 */
class MoveAction
{
    /**
     * Object invokable method
     *
     * Handles Action execution
     *
     * @param Game $game
     * @param int  $coordinateX
     * @param int  $coordinateY
     *
     * @return array
     */
    public function __invoke(Game $game, int $coordinateX, int $coordinateY): array
    {
        try {
            // make move on game
            $board = $game->move($coordinateX, $coordinateY);
            return [
                'result' => true,
                'data' => [
                    'gameOver' => !empty($game->isAWinner($board->statusToArray())) || !$game->isMovesLeft($board->statusToArray()),
                    'board' => $board,
                ]
            ];
        } catch (GameFinishStatusException $e) {
            return [
                'result' => false,
                'data' => [
                    'gameOver' => true,
                    'message' => $e->getMessage(),
                ],
            ];
        } catch (\Exception $e) {
            return [
                'result' => false,
                'data' => [
                    'gameOver' => false,
                    'message' => $e->getMessage(),
                ],
            ];
        }
    }
}
