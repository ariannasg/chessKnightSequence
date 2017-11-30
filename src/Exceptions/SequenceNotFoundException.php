<?php
declare(strict_types=1);

namespace Exceptions;

use Exception;

class SequenceNotFoundException extends Exception
{
    protected $message = "\nOps! No sequence found for moving the knight on those positions.\n"
    . "Try again with a different one!\n\n";
}