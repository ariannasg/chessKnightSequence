<?php
declare(strict_types=1);

use Models\BoardPosition;
use Models\ChessBoard;

class ChessBoardAndPositionsTest extends \PHPUnit\Framework\TestCase
{
    public function testChessBoardCreation()
    {
        $board = new ChessBoard();

        self::assertInstanceOf(ChessBoard::class, $board);
        self::assertEquals(8, $board::MAX_NUMBER_ROWS);
        self::assertEquals(8, $board::MAX_NUMBER_COLUMNS);
    }

    public function testBoardPositionCreation()
    {
        $position = new BoardPosition();

        self::assertInstanceOf(BoardPosition::class, $position);
        self::assertEquals(0, $position->getRowIndex());
        self::assertEquals(0, $position->getColIndex());
        self::assertEquals([], $position->getSequenceOfPrettyPositions());
    }

    public function testPositionsPrettifier()
    {
        $position = new BoardPosition(0, 7);
        self::assertEquals('A8', $position->prettify());

        $position = new BoardPosition(1, 6);
        self::assertEquals('B7', $position->prettify());
    }

    public function testIfTwoPositionsAreEqual()
    {
        $current_position = new BoardPosition(3, 4);

        $new_position = new BoardPosition(5, 6);
        self::assertEquals(false, $current_position->isEqualTo($new_position));

        $new_position = new BoardPosition(3, 6);
        self::assertEquals(false, $current_position->isEqualTo($new_position));

        $new_position = new BoardPosition(2, 4);
        self::assertEquals(false, $current_position->isEqualTo($new_position));

        $new_position = new BoardPosition(3, 4);
        self::assertEquals(true, $current_position->isEqualTo($new_position));
    }
}