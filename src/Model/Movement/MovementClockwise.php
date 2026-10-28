<?php
namespace App\Model\Movement;

use App\Model\Abstract\AbstractMovement;
use App\Model\Token;
use App\Interface\BoardInterface;

/**
 * Class to rotate a token clockwise.
 */
class MovementClockwise extends AbstractMovement
{

    /**
     * Rotate the token clockwise based on its current direction.
     */
    public function moveToken(): Token
    {
        $token = $this->getToken();

        $conversion = [
            'N' => 'E',
            'E' => 'S',
            'S' => 'W',
            'W' => 'N'
        ];
        $token->setDirection($conversion[$token->getDirection()]);

        return $token;
    }

    /**
     * Implement the function but without any actual movement.
     */
    public function moveBoard(): BoardInterface
    {
        return $this->getBoard();
    }

}