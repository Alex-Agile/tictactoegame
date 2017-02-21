<?php
declare(strict_types = 1);

namespace TicTacToeGame\TicTac\Exception;

use Exception;

/**
 * Class TicTacException
 *
 * @package TicTacToeGame\TicTac\Exception
 */
abstract class TicTacException extends Exception
{
    /**
     * TicTacException constructor.
     *
     * Redefines Exception constructor
     *
     * @param string         $message  Exception description message
     * @param int            $code     Exception code
     * @param Exception|null $previous Previous exception
     */
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
