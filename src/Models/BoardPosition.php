<?php
declare(strict_types=1);

namespace Models;

/**
 * Class BoardPosition
 * @package Models
 */
class BoardPosition
{
    public static $prettyColumnNames = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
    public static $prettyRowNames = ['1', '2', '3', '4', '5', '6', '7', '8'];

    /**
     * @var int
     */
    private $colIndex;
    /**
     * @var int
     */
    private $rowIndex;
    /**
     * @var array
     */
    private $sequenceOfPrettyPositions;

    /**
     * BoardPosition constructor.
     * @param int $colIndex
     * @param int $rowIndex
     * @param array $sequenceOfPrettyPositions
     */
    public function __construct(int $colIndex = 0, int $rowIndex = 0, array $sequenceOfPrettyPositions = [])
    {
        $this->colIndex = $colIndex;
        $this->rowIndex = $rowIndex;
        $this->sequenceOfPrettyPositions = $sequenceOfPrettyPositions;
    }

    /**
     * @return int
     */
    public function getColIndex(): int
    {
        return $this->colIndex;
    }

    /**
     * @return int
     */
    public function getRowIndex(): int
    {
        return $this->rowIndex;
    }

    /**
     * @return array
     */
    public function getSequenceOfPrettyPositions(): array
    {
        return $this->sequenceOfPrettyPositions;
    }

    /**
     * @param BoardPosition $boardPosition
     * @return bool
     */
    public function isEqualTo(BoardPosition $boardPosition): bool
    {
        return $this->colIndex == $boardPosition->colIndex && $this->rowIndex == $boardPosition->rowIndex;
    }

    /**
     * @return string
     */
    public function prettify(): string
    {
        return self::$prettyColumnNames[$this->colIndex] . self::$prettyRowNames[$this->rowIndex];
    }
}
