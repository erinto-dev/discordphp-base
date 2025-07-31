<?php

namespace App\Domain\Exception\User;

use Exception;

class CreatingUserException extends Exception
{

  public function __construct(
    string $message = "Ocorreu um erro ao criar sua conta...",
    int $code = 401
  )
  {
    parent::__construct($message, $code);
  }

}
