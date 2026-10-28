<?php
namespace App\Services;

use App\Interface\TokenInterface;
use App\Model\BoardRectangle;
use App\Model\Token;
use App\Model\Movement\MovementFactory;

/**
 * This service runs the whole simulation and needs an array of commands to do so.
 * It starts by reading the header commands and create a board and a token.
 * Then it executes the rest of the commands to move the token accordingly.
 * 
 * It responds with a string representing the final position as [row,col]
 * In the case of error, it just returns [-1, -1]
 */
class Simulate
{
    /**
     * Run the simulation for the given commands.
     */
    static public function run(array $commands): array
    {
        // Set the default result as the error one
        $errorResult = [-1, -1];
        
        // Check that we have at least 1 command to execute
        // The first four are the headers
        if (count($commands) <= 4) {
            return $errorResult;
        }

        // Create a board
        $board = new BoardRectangle();
        $board->setWidth($commands[0]);
        $board->setHeight($commands[1]);

        // Create a token
        $token = new Token();
        $token->setCol($commands[2]);
        $token->setRow($commands[3]);

        // Run the rest of the simulation
        // We expect that the commands are the ones defined (0, 1, 2, 3, 4)
        // Whatever other command, the simulation will just ignore it.
        $commands = array_slice($commands, 4);
        foreach ($commands as $command) {
            switch ($command) {
                case 0:
                    return [$token->getCol(), $token->getRow()];
                    break;
                case 1:
                    $token = MovementFactory::moveToken('forward', $token, $board);
                break;
                case 2:
                    $token = MovementFactory::moveToken('backward', $token, $board);
                break;
                case 3:
                    $token = MovementFactory::moveToken('clockwise', $token, $board);
                break;
                case 4:
                    $token = MovementFactory::moveToken('clockwise_reverse', $token, $board);
                break;
            }

            // Check if the token is in an invalid place after the movement
            if (!$board->isPositionValid($token->getRow(), $token->getCol())) {
                return $errorResult;
            }
        }

        return [$token->getCol(), $token->getRow()];
    }
}