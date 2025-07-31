<?php

namespace App\Domain\Exception\User;

use Exception;

class LongPasswordException extends Exception
{

  public function __construct(
    string $message = "Senha longa demais, máximo permitido é de 30 dígitos!",
    int $code = 401
  )
  {
    parent::__construct($message, $code);
  }

}
