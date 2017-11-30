<?php
declare(strict_types=1);

namespace Exceptions;

use Exception;

class InvalidBoardPositionException extends Exception
{
    protected $message = "\nOps! Could not map the input to the chess board positions! Please check the README file "
    . "and try again with the appropriate format. Example:\n> php run A8 B7 \n\n";
}