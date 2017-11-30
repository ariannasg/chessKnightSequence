<?php
declare(strict_types=1);

namespace Models;

include_once 'BoardPosition.php';

use Exceptions\InvalidBoardPositionException;
use Exceptions\SequenceNotFoundException;
use SplQueue;

/**
 * Class ChessBoard
 * @package Models
 */
class ChessBoard
{
    const MAX_NUMBER_COLUMNS = 8;
    const MAX_NUMBER_ROWS = 8;

    /**
     * NOTE: Changing the order of this array's elements will modified the returned positions for the shortest sequence.
     * The size of the sequence won't be altered.
     *
     * This is just a translation of how the knight can move from a given position to the next;
     * where the first index of each element in the array is the number of rows (- is down and + is up on the board)
     * and the second index as the number of columns (- is to the left and + to the right on the board).
     */
    private $validKnightMovesCombinations = [
        [-2, -1], [1, 2], [1, -2], [-1, 2], [-1, -2], [2, -1], [2, 1], [-2, 1]
    ];


    /**
     * @param string $commandArg1
     * @param string $commandArg2
     */
    public function tryToFindValidSequence(string $commandArg1, string $commandArg2)
    {
        try {
            $this->checkCommandsFormats($commandArg1, $commandArg2);

            $starting_position = $this->createBoardPositionFromPrettyInput($commandArg1[0], $commandArg1[1]);
            $end_position = $this->createBoardPositionFromPrettyInput($commandArg2[0], $commandArg2[1]);

            $sequence = $this->findShortestSequenceOfValidMoves($starting_position, $end_position);

            echo sprintf("\nFound a %s step(s) sequence for moving the knight from %s to %s:\n",
                    sizeof($sequence),
                    strtoupper($commandArg1),
                    strtoupper($commandArg2)
                ) . implode($sequence, ', ') . "\n\n";
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @param string $commandArg1
     * @param string $commandArg2
     * @throws InvalidBoardPositionException
     */
    private function checkCommandsFormats(string $commandArg1, string $commandArg2)
    {
        if (strlen($commandArg1) != 2 || strlen($commandArg2) != 2)
            throw new InvalidBoardPositionException();
    }

    /**
     * @param string $columnLetter
     * @param string $rowNumber
     * @return BoardPosition
     * @throws InvalidBoardPositionException
     */
    private function createBoardPositionFromPrettyInput(string $columnLetter, string $rowNumber): BoardPosition
    {
        $col_index = array_search(strtoupper($columnLetter), BoardPosition::$prettyColumnNames);
        $row_index = array_search($rowNumber, BoardPosition::$prettyRowNames);

        if (is_int($col_index) && is_int($row_index) && $this->areIndexesInsideBoard($col_index, $row_index))
            return new BoardPosition($col_index, $row_index);

        throw new InvalidBoardPositionException();
    }

    /**
     * @param int $colIndex
     * @param int $rowIndex
     * @return bool
     */
    private function areIndexesInsideBoard(int $colIndex, int $rowIndex): bool
    {
        return $colIndex >= 0 && $colIndex < self::MAX_NUMBER_COLUMNS
            && $rowIndex >= 0 && $rowIndex < self::MAX_NUMBER_ROWS;
    }

    /**
     * @param BoardPosition $startingPosition
     * @param BoardPosition $endPosition
     * @return array
     * @throws SequenceNotFoundException
     */
    public function findShortestSequenceOfValidMoves(BoardPosition $startingPosition, BoardPosition $endPosition): array
    {
        $checked_positions = [];

        $positions_queue = new SplQueue();
        $positions_queue->enqueue($startingPosition);

        while (!$positions_queue->isEmpty()) {
            $current_position = $positions_queue->dequeue();

            if ($current_position->isEqualTo($endPosition)) {
                return $current_position->getSequenceOfPrettyPositions();
            }

            if (!in_array($current_position->prettify(), $checked_positions)) {
                $checked_positions[] = $current_position->prettify();

                foreach ($this->validKnightMovesCombinations as $combination) {
                    $potential_next_col_index = $current_position->getColIndex() + $combination[1];
                    $potential_next_row_index = $current_position->getRowIndex() + $combination[0];

                    if ($this->areIndexesInsideBoard($potential_next_col_index, $potential_next_row_index)) {
                        $sequence = array_merge(
                            $current_position->getSequenceOfPrettyPositions(),
                            [$this->getPrettifiedPositionFromIndexes($potential_next_col_index, $potential_next_row_index)]
                        );

                        $next_position = new BoardPosition($potential_next_col_index, $potential_next_row_index, $sequence);
                        $positions_queue->enqueue($next_position);
                    }
                }
            }
        }

        throw new SequenceNotFoundException();
    }

    /**
     * @param int $colIndex
     * @param int $rowIndex
     * @return string
     */
    private function getPrettifiedPositionFromIndexes(int $colIndex, int $rowIndex): string
    {
        return BoardPosition::$prettyColumnNames[$colIndex] . BoardPosition::$prettyRowNames[$rowIndex];
    }
}
