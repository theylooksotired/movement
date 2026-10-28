<?php
namespace App\Interface;

/**
 * Interface for a board.
 * Any board is an array of the figure (inside a rectangle).
 * The values can be true or false defining the shape.
 * 
 * For example, an array of a rectangular board:
 * T T T T
 * T T T T
 * T T T T
 * 
 * A triangular one:
 * F F T F F
 * F T T T F
 * T T T T T
 */
interface BoardInterface
{

    // Get an array (filled with true/false items) with the shape of the board
    public function getBoard(): array;
    
    // Check if a position is valid (true) or not (false)
    public function isPositionValid(int $row, int $col): bool;

}