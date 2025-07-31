<?php

namespace App\Application\Actions\User;

use App\Domain\Exception\User\CreatingUserException;
use App\Domain\Exception\User\DiscordUserIdAlreadyRegisteredException;
use App\Domain\Exception\User\EmailAlreadyInUseException;
use App\Domain\Exception\User\EmailInvalidException;
use App\Domain\Exception\User\EmailOrPassUndefinedException;
use App\Domain\Exception\User\LongPasswordException;
use App\Domain\Exception\User\RegisterException;
use App\Domain\Exception\User\ShortPasswordException;
use App\Domain\Repository\UserRepositoryInterface;
use Psr\Container\ContainerInterface;

final class RegisterAction
{

  public function __construct(
    private ContainerInterface $containerInterface
  ) {
  }

  public function execute(array $data)
  {
    $email = $data["email"];
    $senha = $data["senha"];
    $discord_id = $data["discord_id"];

    if (!isset($email) || !isset($senha)) throw new EmailOrPassUndefinedException();

    if (strlen($senha) < 6) throw new ShortPasswordException();
    if (strlen($senha) > 30) throw new LongPasswordException();

    $emailValid = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (!$emailValid) throw new EmailInvalidException();

    $user = $this->containerInterface->get(UserRepositoryInterface::class)->getUserByDiscordId($discord_id);
    if($user) throw new DiscordUserIdAlreadyRegisteredException();
    $user = $this->containerInterface->get(UserRepositoryInterface::class)->getUserByEmail($email);

    if ($user) throw new EmailAlreadyInUseException();

    if (!isset($discord_id)) {
      $discord_id = null;
    }
    $creating = $this->containerInterface->get(UserRepositoryInterface::class)->createUser($email, $senha, $discord_id);

    if (!$creating) throw new CreatingUserException();
    return ["error" => false, "message" => "Cadastrado no sistema!", "code" => 201];
  }
}
