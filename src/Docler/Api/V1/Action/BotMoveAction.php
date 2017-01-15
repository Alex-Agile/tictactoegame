<?php
declare(strict_types = 1);

namespace Docler\Api\V1\Action;

use Docler\TicTac\Domain\Bot\Bot;
use Docler\TicTac\Domain\Game;
use Docler\TicTac\Exception\GameFinishStatusException;

/**
 * Class BotMoveAction
 *
 * Action (ADR) class for Bot move Api call
 *
 * @package Docler\Api\V1\Action
 */
class BotMoveAction
{
    /**
     * Object invokable method
     *
     * Handles Action execution
     *
     * @param Game $game
     *
     * @return array
     */
    public function __invoke(Game $game): array
    {
        try {
            // instantiate Bot
            $bot = new Bot();

            // get next move from Bot
            list($coordinateX, $coordinateY) = $bot->makeMove($game->getBoard()->statusToArray(), Game::BOT_TEAM);

            // make move on game
            $board = $game->move($coordinateX, $coordinateY);
            return [
                'result' => true,
                'data' => [
                    'gameOver' => !empty($game->isAWinner($board->statusToArray())),
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
