<?php

namespace App\Exceptions;

use Exception;

class check_last_record extends Exception
{
    public function Error($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
}
