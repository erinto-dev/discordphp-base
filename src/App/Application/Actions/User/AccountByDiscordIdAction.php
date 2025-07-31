<?php

namespace App\Application\Actions\User;

use App\Domain\Exception\User\DiscordIdUndefinedException;
use App\Domain\Exception\User\RegisterException;
use App\Domain\Repository\UserRepositoryInterface;
use Psr\Container\ContainerInterface;

final class AccountByDiscordIdAction
{

  public function __construct(
    private ContainerInterface $containerInterface
  ) {
  }

  public function execute(array $data)
  {
    $discord_id = $data["discord_id"];
    if(!isset($discord_id)) throw new DiscordIdUndefinedException();
    $userRepo = $this->containerInterface->get(UserRepositoryInterface::class);

    $user = $userRepo->getUserByDiscordId($discord_id);
    if(!$user) throw new RegisterException();
    return ["error" => false, "message" => "Informações da conta", "code" => 201, "details" => $user];
  }
}
