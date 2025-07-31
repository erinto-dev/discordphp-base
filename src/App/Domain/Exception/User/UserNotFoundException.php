<?php

namespace App\Domain\Exception\User;

use Exception;

class UserNotFoundException extends Exception
{

  public function __construct(
    string $message = "Este usuário não existe!",
    int $code = 404
  )
  {
    parent::__construct($message, $code);
  }

}
