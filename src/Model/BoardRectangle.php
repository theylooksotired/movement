<?php
namespace App\Model;

use App\Interface\BoardInterface;

/**
 * This is a rectangular board, defined by its width and height.
 * All the positions inside the board are considered valid (check the function isPositionValid).
 */
class BoardRectangle implements BoardInterface
{
    private int $width;
    private int $height;

    /**
     * Get the width.
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * Get the height.
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * Set the width.
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * Set the height.
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * Create the board as an array with all the positions set to true.
     */
    public function getBoard(): array
    {
        $board = [];
        for ($col = 0; $col < $this->getWidth(); $col++) {
            for ($row = 0; $row < $this->getHeight(); $row++) {
                $board[$col][$row] = true;
            }
        }
        return $board;
    }

    /**
     * Check if a position is valid.
     * In this case is valid if it just exists inside the board.
     */
    public function isPositionValid(int $row, int $col): bool
    {
        $board = $this->getBoard();
        return (isset($board[$row][$col]) && $board[$row][$col]) ? true : false;
    }

}