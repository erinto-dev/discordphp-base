<?php

namespace App\Domain\Exception\User;

use Exception;

class EmailAlreadyInUseException extends Exception
{

  public function __construct(
    string $message = "Este email já está em uso, use outro!",
    int $code = 401
  )
  {
    parent::__construct($message, $code);
  }

}
