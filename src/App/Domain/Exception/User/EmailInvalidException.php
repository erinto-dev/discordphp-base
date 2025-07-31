<?php

namespace App\Domain\Exception\User;

use Exception;

class EmailInvalidException extends Exception
{

  public function __construct(
    string $message = "Este formato de email não é aceito em nosso sistema!",
    int $code = 401
  )
  {
    parent::__construct($message, $code);
  }

}
