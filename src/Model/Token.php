<?php
namespace App\Model;

/**
 * This class represents a token.
 * Each token has a position (row and column) and a direction.
 */
class Token
{
    private int $col = 0;
    private int $row = 0;
    private string $direction = 'N';

    /**
     * Get the column.
     */
    public function getCol(): int
    {
        return $this->col;
    }

    /**
     * Get the row.
     */
    public function getRow(): int
    {
        return $this->row;
    }

    /**
     * Get the direction.
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * Set the column.
     */
    public function setCol(int $col): void
    {
        $this->col = $col;
    }

    /**
     * Set the row.
     */
    public function setRow(int $row): void
    {
        $this->row = $row;
    }

    /**
     * Set the direction.
     */
    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }

}