<?php

namespace App\Model\Movement;

use App\Interface\BoardInterface;
use App\Model\Token;
use App\Model\Movement\MovementBackward;
use App\Model\Movement\MovementForward;
use App\Model\Movement\MovementClockwise;
use App\Model\Movement\MovementClockwiseReverse;

/**
 * Factory class to run movements.
 */
class MovementFactory
{

    /**
     * Create a movement instance based on the type.
     */
    public static function create(
        string $type,
        Token $token,
        BoardInterface $board
    ) {
        switch ($type) {
            case 'forward':
                return new MovementForward($token, $board);
            case 'backward':
                return new MovementBackward($token, $board);
            case 'clockwise':
                return new MovementClockwise($token, $board);
            case 'clockwise_reverse':
                return new MovementClockwiseReverse($token, $board);
            default:
                throw new \InvalidArgumentException("Invalid type: $type");
        }

        // Any movement should move the token and the board as well.
        $movement->moveToken();
        $movement->moveBoard();

        return $movement;
    }

    /**
     * Move the token based on the type of movement.
     * For this exercise the types are 'forward', 'backward', 'clockwise', and 'clockwise_reverse'.
     */
    public static function moveToken(
        string $type,
        Token $token,
        BoardInterface $board
    ): Token {
        $movement = MovementFactory::create($type, $token, $board);
        return $movement->moveToken();
    }

    /**
     * Move the board based on the type of movement.
     * We don't have any type for this exercise.
     */
    public static function moveBoard(
        string $type,
        Token $token,
        BoardInterface $board
    ): BoardInterface {
        $movement = MovementFactory::create($type, $token, $board);
        return $movement->moveBoard();
    }

}