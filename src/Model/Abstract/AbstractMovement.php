<?php
namespace App\Model\Abstract;

use App\Interface\BoardInterface;
use App\Model\Token;

/**
 * This is an abstract class to define a movement.
 * Basically a movement means changing a token or the board.
 * 
 * Right now, in the case of the token we can advance, move backward, or rotate it.
 * For the board we have no movement defined yet, but everything is in place when needed.
 */
abstract class AbstractMovement
{
    private Token $token;
    private BoardInterface $board;

    /**
     * Simple constructor.
     */
    public function __construct(Token $token, BoardInterface $board)
    {
        $this->token = $token;
        $this->board = $board;
    }

    /**
     * Get the token.
     */
    public function getToken(): Token
    {
        return $this->token;
    }

    /**
     * Get the board.
     */
    public function getBoard(): BoardInterface
    {
        return $this->board;
    }

    /**
     * Set the token.
     */
    public function setToken(Token $token): void
    {
        $this->token = $token;
    }

    /**
     * Set the board.
     */
    public function setBoard(BoardInterface $board): void
    {
        $this->board = $board;
    }

    // Abstract method to define the movement of a token.
    abstract public function moveToken(): Token;

    // Abstract method to define the movement of a board.
    abstract public function moveBoard(): BoardInterface;

}