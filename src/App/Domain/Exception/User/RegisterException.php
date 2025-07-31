<?php

namespace App\Domain\Exception\User;

use Exception;

class RegisterException extends Exception
{

  public function __construct(
    string $message = "Você precisa ser registrado!",
    int $code = 400
  )
  {
    parent::__construct($message, $code);
  }

}
