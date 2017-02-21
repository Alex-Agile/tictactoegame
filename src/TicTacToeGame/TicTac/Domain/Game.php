<?php
declare(strict_types = 1);

namespace TicTacToeGame\TicTac\Domain;

use TicTacToeGame\TicTac\Domain\Grid\Board;
use TicTacToeGame\TicTac\Domain\Grid\Cell;
use TicTacToeGame\TicTac\Exception\GameFinishStatusException;
use TicTacToeGame\TicTac\Exception\InvalidPositionException;
use TicTacToeGame\TicTac\Exception\NotEmptyPositionException;

/**
 * Class Game
 *
 * Implements game main logic
 *
 * Takes care of game statuses, generates and keeps board and makes moves
 *
 * @package TicTacToeGame\TicTac\Domain
 */
class Game
{
    use VictoryChecker;
    use DrawChecker;

    /** @var string GAME_TEAM_X */
    const GAME_TEAM_X = 'X';

    /** @var string GAME_TEAM_O */
    const GAME_TEAM_O = 'O';

    /** @var string BOT_TEAM */
    const BOT_TEAM = self::GAME_TEAM_O;

    /** @var string OPPONENT_TEAM */
    const OPPONENT_TEAM = self::GAME_TEAM_X;

    /** @var string GAME_STATUS_NEW */
    const GAME_STATUS_NEW = 'game_status_new';

    /** @var string GAME_STATUS_WAITING_MOVE */
    const GAME_STATUS_WAITING_MOVE = 'game_status_waiting_move';

    /** @var string GAME_STATUS_FINISH */
    const GAME_STATUS_FINISH = 'game_status_finish';

    /** @var Board $board Board object */
    private $board;

    /** @var string $gameStatus Current game status */
    private $gameStatus = '';

    /** @var string $turn Current turn team */
    private $turn = '';

    /**
     * Game constructor.
     *
     * @param Board $board
     */
    public function __construct(Board $board)
    {
        $this->setBoard($board);
        $this->init();
    }

    /**
     * Orchestrates the process of making a move
     *
     * Takes care of errors, checks for a winner or finish the game if not moves left
     *
     * @param int $coordinateX
     * @param int $coordinateY
     *
     * @return Board
     *
     * @throws GameFinishStatusException If game is over
     * @throws InvalidPositionException  If Board invalid position
     * @throws NotEmptyPositionException If Board not empty position
     */
    public function move(int $coordinateX, int $coordinateY): Board
    {
        // if game is over throws an exception
        if ($this->getGameStatus() == self::GAME_STATUS_FINISH) {
            throw new GameFinishStatusException('Game is over.');
        }

        // if game is new starts game
        if ($this->getGameStatus() == self::GAME_STATUS_NEW) {
            $this->setGameStatus(self::GAME_STATUS_WAITING_MOVE);
        }

        try {
            // makes move
            $this->getBoard()->setGamePiece($coordinateX, $coordinateY, $this->getTurn());

            // updates turn
            $this->setTurn($this->getTurn() === 'X' ? Game::GAME_TEAM_O : Game::GAME_TEAM_X);

            // if there is a winner updates winner board cells
            $boardState = $this->getBoard()->statusToArray();
            $winner = $this->isAWinner($boardState);
            if (!empty($winner)) {
                foreach ($winner['coordinates'] as $coordinate) {
                    /** @var Cell $cell */
                    $cell = $this->getBoard()->getBoardState()[$coordinate[0]][$coordinate[1]];
                    $cell->setWinner(true);
                }
            }

            // if there is a winner or not moves left finish game
            if (!empty($winner) || !$this->isMovesLeft($boardState)) {
                $this->setGameStatus(self::GAME_STATUS_FINISH);
            }
        } catch (InvalidPositionException $e) {
            // same exception rethrown to improve doc
            throw $e;
        } catch (NotEmptyPositionException $e) {
            // same exception rethrown to improve doc
            throw $e;
        }

        return $this->getBoard();
    }

    /**
     * Initializes an new game
     */
    private function init()
    {
        $this->getBoard()->init();
        $this->setTurn(self::GAME_TEAM_X);
        $this->setGameStatus(self::GAME_STATUS_NEW);
    }

    /**
     * Board setter
     *
     * @param Board $board
     *
     * @return Game
     */
    public function setBoard(Board $board)
    {
        $this->board = $board;

        return $this;
    }

    /**
     * Board getter
     *
     * @return mixed
     */
    public function getBoard(): Board
    {
        return $this->board;
    }

    /**
     * GameStatus setter
     *
     * @param string $gameStatus
     *
     * @return Game
     */
    public function setGameStatus(string $gameStatus): Game
    {
        $this->gameStatus = $gameStatus;

        return $this;
    }

    /**
     * GameStatus getter
     *
     * @return string
     */
    public function getGameStatus(): string
    {
        return $this->gameStatus;
    }

    /**
     * Turn setter
     *
     * @param string $turn
     *
     * @return Game
     */
    public function setTurn(string $turn)
    {
        $this->turn = $turn;

        return $this;
    }

    /**
     * Turn getter
     *
     * @return mixed
     */
    public function getTurn()
    {
        return $this->turn;
    }
}
