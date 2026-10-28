<?php
namespace App\Model\Movement;

use App\Model\Abstract\AbstractMovement;
use App\Model\Token;
use App\Interface\BoardInterface;

/**
 * Class to move a token forward.
 */
class MovementForward extends AbstractMovement
{

    /**
     * Move the token forward based on its current direction.
     */
    public function moveToken(): Token
    {
        $token = $this->getToken();

        switch($token->getDirection()) {
            case 'N':
                $token->setRow($token->getRow() - 1);
                break;
            case 'E':
                $token->setCol($token->getCol() + 1);
                break;
            case 'S':
                $token->setRow($token->getRow() + 1);
                break;
            case 'W':
                $token->setCol($token->getCol() - 1);
                break;
        }

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