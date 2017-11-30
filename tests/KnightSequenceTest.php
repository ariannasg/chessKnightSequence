<?php
declare(strict_types=1);

use Models\BoardPosition;
use Models\ChessBoard;

class KnightSequenceTest extends \PHPUnit\Framework\TestCase
{
    public function testShortestSequenceBetweenPaths()
    {
        $board = new ChessBoard();

        $start_position = new BoardPosition(0, 7);
        $end_position = new BoardPosition(1, 6);
        self::assertEquals(['C7', 'B5', 'D6', 'B7'], $board->findShortestSequenceOfValidMoves($start_position, $end_position));

        $start_position = new BoardPosition(4, 0);
        $end_position = new BoardPosition(0, 6);
        self::assertEquals(['C2', 'A3', 'B5', 'A7'], $board->findShortestSequenceOfValidMoves($start_position, $end_position));
    }
}