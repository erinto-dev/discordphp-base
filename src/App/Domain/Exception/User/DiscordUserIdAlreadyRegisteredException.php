<?php

namespace App\Domain\Exception\User;

use Exception;

class DiscordUserIdAlreadyRegisteredException extends Exception
{

  public function __construct(
    string $message = "Sua conta já está  registrado em nosso serviço, use /conta para recuperar informações sobre ela",
    int $code = 401
  )
  {
    parent::__construct($message, $code);
  }

}
