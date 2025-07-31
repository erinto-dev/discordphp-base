<?php

namespace App\Domain\Exception\User;

use Exception;

class EmailOrPassUndefinedException extends Exception
{

  public function __construct(
    string $message = "Faltando Email ou senha...",
    int $code = 401
  )
  {
    parent::__construct($message, $code);
  }

}
