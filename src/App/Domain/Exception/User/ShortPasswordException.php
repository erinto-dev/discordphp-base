<?php

namespace App\Domain\Exception\User;

use Exception;

class ShortPasswordException extends Exception
{

  public function __construct(
    string $message = "Senha curta demais, mínimo permitido é de 6 dígitos!",
    int $code = 401
  )
  {
    parent::__construct($message, $code);
  }

}
