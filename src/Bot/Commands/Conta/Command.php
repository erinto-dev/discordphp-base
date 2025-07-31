<?php

namespace Bot\Commands\Conta;

use App\Application\Actions\User\AccountByDiscordIdAction;
use Discord\Parts\Interactions\Interaction;
use Exception;
use Psr\Container\ContainerInterface;

class Command
{

    public string $name = "conta";
    public string $desc = "Comando recupera informações sobre sua conta";
public function __construct(
    private ContainerInterface $containerInterface
  )
  {
    
  }

    public function execute(Interaction $interaction): void
    {
      try {
        $conta = new AccountByDiscordIdAction($this->containerInterface);
        $conta = $conta->execute(["discord_id" => $interaction->user->id]);

        $emailAlreadyVerified = (bool) $conta["details"]["email_verified"] ? "verificado" : "Não verificado";

        $interaction->respondWithMessage("Email: ".$conta["details"]["email"]."\nConta verificada: ".$emailAlreadyVerified, true);
      } catch (Exception $e) {
        $interaction->respondWithMessage($e->getMessage(), true);
      }
    }
}
