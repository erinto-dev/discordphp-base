<?php

namespace App\Domain\Exception\User;

use Exception;

class DiscordIdUndefinedException extends Exception
{

  public function __construct(
    string $message = "Está faltando o id do discord...",
    int $code = 401
  )
  {
    parent::__construct($message, $code);
  }

}
